DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS follow_category CASCADE;
DROP TABLE IF EXISTS reference CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS saved_post CASCADE;
DROP TABLE IF EXISTS post_reference CASCADE;
DROP TABLE IF EXISTS post_vote CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS follow CASCADE;
DROP TABLE IF EXISTS "notification" CASCADE;
DROP TABLE IF EXISTS "user" CASCADE;


DROP TYPE IF EXISTS user_state;
DROP TYPE IF EXISTS report_state;

DROP INDEX IF EXISTS post_category ; 
DROP INDEX IF EXISTS post_user_id;  
DROP INDEX IF EXISTS post_vote_value ;
DROP INDEX IF EXISTS comment_info;
DROP INDEX IF EXISTS get_notification;
DROP INDEX IF EXISTS get_unanswered_reports;
DROP INDEX IF EXISTS post_search_index;
DROP INDEX IF EXISTS user_search_index;


DROP FUNCTION IF EXISTS comment_on_post();
DROP FUNCTION IF EXISTS vote_on_post();
DROP FUNCTION IF EXISTS follow_user();

DROP TRIGGER IF EXISTS comment_on_post on comment;
DROP TRIGGER IF EXISTS vote_on_post on post;
DROP TRIGGER IF EXISTS follow_user on follow;


DROP EXTENSION IF EXISTS pgcrypto;

CREATE TYPE user_state AS ENUM ('Banned', 'Suspended', 'Active');
CREATE TYPE report_state AS ENUM ('Accepted', 'Deleted', 'SuspendedUser', 'BanedUser', 'NotAnswered');

CREATE TABLE "user"(
    id SERIAL PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    photo TEXT,
    state user_state NOT NULL, 
    is_admin BOOLEAN NOT NULL
);

CREATE TABLE category(
  id SERIAL PRIMARY KEY,
  name text UNIQUE NOT NULL 
);

CREATE TABLE follow_category(
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    category_id INTEGER NOT NULL REFERENCES category(id),
    PRIMARY KEY (user_id, category_id)
);

CREATE TABLE reference(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE post(
    id SERIAL PRIMARY KEY,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    user_id INTEGER REFERENCES "user"(id) NOT NULL,
    title TEXT NOT NULL,
    header TEXT NOT NULL,
    body TEXT NOT NULL,
    category INTEGER REFERENCES category(id) NOT NULL,
    upvotes int NOT NULL DEFAULT 0,
    downvotes int NOT NULL DEFAULT 0
);

CREATE TABLE saved_post(
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id),
    PRIMARY KEY (user_id, post_id)
);

CREATE TABLE post_reference(
    post_id INTEGER REFERENCES post(id),
    reference_id INTEGER REFERENCES reference(id),
    PRIMARY KEY(post_id, reference_id)
);


CREATE TABLE post_vote (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id),
    UNIQUE(user_id,post_id),
    is_up BOOLEAN NOT NULL
);
CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id) ON DELETE CASCADE,
    body text,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    comment_id INTEGER REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    state report_state NOT NULL,
    comment_id INTEGER REFERENCES comment(id) ON DELETE CASCADE,
    post_id INTEGER REFERENCES post(id) ON DELETE CASCADE,
    admin_id INTEGER REFERENCES "user"(id) ON DELETE CASCADE,
    UNIQUE(user_id,comment_id),
    UNIQUE(user_id,post_id)
);

CREATE TABLE follow(
    follower INTEGER NOT NULL REFERENCES "user"(id),
    followed INTEGER NOT NULL REFERENCES "user"(id),
    PRIMARY KEY (follower, followed)
);


CREATE TABLE "notification"(
  id SERIAL PRIMARY KEY,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  is_read BOOLEAN,
  receiver INTEGER REFERENCES "user"(id),
  vote_id INTEGER REFERENCES post_vote(id), 
  comment_id INTEGER REFERENCES comment(id),
  follower_id INTEGER REFERENCES "user"(id)
);


CREATE INDEX post_category ON post USING hash (category); 

CREATE INDEX post_user_id ON post USING hash (user_id);  

CREATE INDEX post_vote_value ON post_vote USING hash (is_up);

CREATE INDEX comment_info ON comment USING btree (post_id, user_id);

CREATE INDEX get_notification ON "notification" USING hash (receiver);

CREATE INDEX get_unanswered_reports ON report USING btree (state, user_id);


CREATE INDEX post_search_index ON post
USING GIST ((setweight(to_tsvector('english', title),'A') || 
       setweight(to_tsvector('english', header), 'B')|| 
       setweight(to_tsvector('english', body), 'C')));


CREATE INDEX user_search_index ON "user"
USING GIST ((setweight(to_tsvector('english', username),'A') || 
       setweight(to_tsvector('english', name), 'B')));


CREATE FUNCTION vote_on_post() RETURNS TRIGGER AS
$BODY$
BEGIN

	IF TG_OP = 'INSERT'
	THEN 
		IF EXISTS ( SELECT *
					FROM post
					WHERE NEW.post_id = post.id AND NEW.user_id = post.user_id )
		THEN
			RAISE EXCEPTION 'A member_user cannot vote on their own posts.';
		END IF;
        
	ELSIF TG_OP = 'UPDATE'
	THEN 
	IF OLD.is_up
		THEN
			UPDATE post
			SET upvotes = upvotes - 1
			WHERE id = OLD.post_id;

	ELSIF NOT OLD.is_up
		THEN
			UPDATE post
			SET downvotes = downvotes - 1
			WHERE id = OLD.post_id;
		END IF;
	END IF;
	
	IF NEW.is_up
		THEN
			UPDATE post
			SET upvotes = upvotes + 1
			WHERE id = NEW.post_id;
	ELSIF NOT NEW.is_up
		THEN
			UPDATE post
			SET downvotes = downvotes + 1
			WHERE id = NEW.post_id;
    END IF;

	/*Create notification part*/

	
	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (FALSE, NEW.user_id, NEW.id, null, null);

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER vote_on_post
    AFTER INSERT OR UPDATE ON post_vote
    FOR EACH ROW
    EXECUTE PROCEDURE vote_on_post();


CREATE FUNCTION comment_on_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (
			SELECT *
			FROM post
			WHERE NEW.post_id= id AND NEW."datetime" < "datetime" )
		THEN
			RAISE EXCEPTION 'The comment''s time_stamp must be after the post''s time_stamp. %', New.post_id ;
	END IF;



	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (FALSE, NEW.user_id , null, NEW.id, NEW.id);
	
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;



/*TRIGGER 3*/
CREATE FUNCTION follow_user() RETURNS TRIGGER AS
$BODY$
BEGIN
	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (false, NEW.followed, NULL, NULL, NEW.follower);
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER follow_user
    AFTER INSERT ON follow
    FOR EACH ROW
    EXECUTE PROCEDURE follow_user();


 
CREATE TRIGGER comment_on_post
    AFTER INSERT ON comment
    FOR EACH ROW
    EXECUTE PROCEDURE comment_on_post();
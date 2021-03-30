/*
bloquear / suspender/ expulsar user 
*/


/*TRIGGER 1*/
CREATE FUNCTION vote_on_post() RETURNS TRIGGER AS
$BODY$
BEGIN

	IF TG_OP = 'INSERT'
	THEN 
		IF EXISTS ( SELECT *
					FROM post
					WHERE NEW.id_post = post.id AND NEW.id_user = post.id_author )
		THEN
			RAISE EXCEPTION 'A member_user cannot vote on their own posts.';
		END IF;
        
	ELSIF TG_OP = 'UPDATE'
	THEN 
	IF OLD.is_up
		THEN
			UPDATE post
			SET upvotes = upvotes - 1
			WHERE id = OLD.id_post;

	ELSIF NOT OLD.is_up
		THEN
			UPDATE post
			SET downvotes = downvotes - 1
			WHERE id = OLD.id_post;
		END IF;
	END IF;
	
	IF NEW.is_up
		THEN
			UPDATE post
			SET upvotes = upvotes + 1
			WHERE id = NEW.id_post;
	ELSIF NOT NEW.is_up
		THEN
			UPDATE post
			SET downvotes = downvotes + 1
			WHERE id = NEW.id_post;
    END IF;

	/*Create notification part*/

	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (FALSE, /*???????????*/, NEW.id, null, null);

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER vote_on_post
    AFTER INSERT OR UPDATE ON post_vote
    FOR EACH ROW
    EXECUTE PROCEDURE vote_on_post();


/*TRIGGER 2*/
CREATE FUNCTION comment_on_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (
			SELECT *
			FROM post
			WHERE NEW.id_post = id AND NEW.time_stamp < time_stamp )
		THEN
			RAISE EXCEPTION 'The comment''s time_stamp must be after the post''s time_stamp. %', New.id_post ;
	END IF;

	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (FALSE, /*??????????*/ , null, NEW.id, NEW.id);
	
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER comment_on_post
    AFTER INSERT ON comment
    FOR EACH ROW
    EXECUTE PROCEDURE comment_on_post();


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



/*TRIGGER 4*/
CREATE FUNCTION delete_comments() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM comment WHERE id=OLD.id
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER delete_post
    AFTER DELETE ON post
    FOR EACH ROW
    EXECUTE PROCEDURE delete_comments();


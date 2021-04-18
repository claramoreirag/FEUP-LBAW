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
					WHERE NEW.id = post.id AND NEW.user_id = post.user_id )
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






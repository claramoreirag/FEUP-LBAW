

/*notificaçao seguir
notificaçao commentar
notificação votar
seguir
deixar de seguir
votar
comentar
datas de comments depois de datas de posts ->  3
bloquear / suspender/ expulsar user 
*/


/*TRIGGER 1*/
CREATE FUNCTION create_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO notification (is_read, id) VALUES (FALSE, NEW.id);
    RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER create_notification
    AFTER INSERT ON request
    FOR EACH ROW
    EXECUTE PROCEDURE create_notification();



/*TRIGGER 2*/
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

	ELSIF OLD.vote_type = 'down'
		THEN
			UPDATE post
				SET downvotes = downvotes - 1
				WHERE id = OLD.id_post;
    	END IF;
	END IF;
	
	IF NEW.vote_type = 'up'
	THEN
		UPDATE post
			SET upvotes = upvotes + 1
			WHERE id = NEW.id_post;
	ELSIF NEW.vote_type = 'down'
	THEN
		UPDATE post
			SET downvotes = downvotes + 1
			WHERE id = NEW.id_post;
    END IF;
	
	UPDATE member_user 
		SET credibility = credibility + sqrt(abs(subquery.upvotes - subquery.downvotes)) * sign(subquery.upvotes - subquery.downvotes) 
		FROM (
			SELECT post.id AS post_id, post.id_author AS author, post.upvotes AS upvotes, post.downvotes AS downvotes
				FROM post
				WHERE post.id = NEW.id_post) AS subquery 
		WHERE member_user.id = subquery.author;
	
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER vote_on_post
    AFTER INSERT OR UPDATE ON post_vote
    FOR EACH ROW
    EXECUTE PROCEDURE vote_on_post();



/*Trigger 3*/
CREATE FUNCTION check_comment_date() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (
		SELECT *
			FROM post
			WHERE NEW.id_post = id AND NEW.time_stamp < time_stamp)
		THEN
			RAISE EXCEPTION 'The comment''s time_stamp must be after the post''s time_stamp. %', New.id_post ;
	END IF;
	
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER check_comment_date
    AFTER INSERT ON comment
    FOR EACH ROW
    EXECUTE PROCEDURE check_comment_date();


    /*Trigger 4*/


CREATE FUNCTION block_user() RETURNS TRIGGER AS 
$BODY$ 
BEGIN 
	IF EXISTS (
		SELECT *
			FROM follow_user 
			WHERE NEW.blocked_user = id_follower AND NEW.blocker_user = id_followed)  
		THEN
			DELETE
				FROM follow_user
				WHERE NEW.blocked_user = id_follower AND NEW.blocker_user = id_followed; 
	END IF;
	
	IF EXISTS (
			SELECT *
			FROM follow_user 
	 		WHERE NEW.blocker_user = id_follower AND NEW.blocked_user = id_followed)  
		THEN 
			DELETE
				FROM follow_user
				WHERE NEW.blocker_user = id_follower AND NEW.blocked_user = id_followed; 
	END IF;

	RETURN NEW; 
END 
$BODY$ 
LANGUAGE plpgsql;
/*TRANSACTION 1*/

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ
INSERT INTO reference(id, name) VALUES ($id, $name);
INSERT INTO post(id, "datetime", user_id, title, header, body, category, upvotes, downvotes) VALUES ($id, $datetime, $user_id, $title, $header, $body, $category, $upvotes, $downvotes); 
COMMIT;
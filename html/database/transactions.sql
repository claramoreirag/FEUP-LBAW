/*TRANSACTION 1*/

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

INSERT INTO report (id, time_stamp, comment_id, post_id, id_admin, id_user) VALUES ($id,  $time_stamp, $comment_id, $post_id, $id_admin, $id_user);

INSERT INTO report (id_report, id_comment, id_post) VALUES ($id, $id_comment, NULL); 

COMMIT;

/*TRANSACTION 2*/

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

INSERT INTO report (id, time_stamp, comment_id, post_id, id_admin, id_user) VALUES ($id,  $time_stamp, $comment_id, $post_id, $id_admin, $id_user);

INSERT INTO post_report (id_report, id_post, id_comment) VALUES ($id, $id_post, NULL); 

COMMIT;

/*TRANSACTION 3*/

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY

SELECT R.id, R.reason, R.time_stamp, REPORTED.photo, REPORTED.username, REPORTER.photo, REPORTER.username
	FROM user_report UR, report R, member_user REPORTER, member_user REPORTED
	WHERE UR.id_report = R.id AND R.id_admin = 3 AND UR.id_user = REPORTED.id AND R.id_user = REPORTER.id;

SELECT R.id, R.reason, R.time_stamp, C.id, C.image, C.name, REPORTER.photo, REPORTER.username
	FROM community_report CR, report R, member_user REPORTER, community C
	WHERE CR.id_report = R.id AND R.id_admin = 3 AND CR.id_community = C.id AND R.id_user = REPORTER.id;

SELECT R.id, R.reason, R.time_stamp, C.id, C.content, P.id, P.title, REPORTER.photo, REPORTER.username
	FROM comment_report CR, report R, member_user REPORTER, comment C, post P
	WHERE CR.id_report = R.id AND R.id_admin = 3 AND CR.id_comment = C.id AND R.id_user = REPORTER.id AND C.id_post = P.id;

SELECT R.id, R.reason, R.time_stamp, P.id, P.title, P.content, C.id, C.name, C.image, REPORTER.photo, REPORTER.username
	FROM post_report PR, report R, member_user REPORTER, post P, community C
	WHERE PR.id_report = R.id AND R.id_admin = 3 AND PR.id_post = P.id AND R.id_user = REPORTER.id AND P.id_community = C.id;

COMMIT;


/*TRANSACTION 4*/

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL READ COMMITTED

	DELETE from comment where id_author = $id_user;
	DELETE from post where id_author = $id_user;

COMMIT;
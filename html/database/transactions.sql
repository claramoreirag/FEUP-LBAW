/*TRANSACTION 1*/
/*When an user is banido apagar todos os posts e comments*/
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL READ COMMITTED
	DELETE from comment where id_author = $id_user;
	DELETE from post where id_author = $id_user;
COMMIT;


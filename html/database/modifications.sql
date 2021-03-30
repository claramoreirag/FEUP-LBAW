
/*Edit profile*/
UPDATE user
	SET username = $username, name = $name, email = $email, password = $password, gender = $gender, photo = $photo, is_admin = $is_admin, user_state=$user_state;
	WHERE id = $id;

/*Edit post*/
UPDATE post
	SET user_id = $user_id, title = $title, header = $header, body = $body, category = $category, upvotes = $upvotes, downvotes=$downvotes;
	WHERE id = $id;


-- adminDashboard

-- Get all report's info (not answered reports)
SELECT report.id, report.date, user.name, report.comment_id, report.post_id
FROM report, user
WHERE report.state="NotAnswered" AND report.user_id = user.id; 

-- get all post reports
SELECT report.id, report.state, report.date, user.name, report.post_id, report.admin_id
FROM report, user
WHERE report.user_id = user.id AND report.comment_id=NULL;

-- get all post reports (unread)
SELECT report.id, report.date, user.name, report.post_id, report.admin_id
FROM report, user
WHERE report.state="NotAnswered" AND report.user_id = user.id AND report.comment_id=NULL;

--get comment reports
SELECT report.id, report.state, report.date, user.name, report.comment_id, report.admin_id
FROM report, user
WHERE report.user_id = user.id AND report.post_id=NULL;

--get comment reports (unread)
SELECT report.id, report.state, report.date, user.name, report.comment_id, report.admin_id
FROM report, user
WHERE report.state="NotAnswered" AND report.user_id = user.id AND report.post_id=NULL;

--get number of reports (post)
SELECT COUNT(*)
FROM report
GROUP BY report.post_id;

--get number of reports (comment)
SELECT COUNT(*)
FROM report
GROUP BY report.comment_id;

--get user by ID (util)
SELECT *
FROM user
WHERE user.id=$userID;

--get post by ID (util)
SELECT *
FROM post
WHERE post.id=$postID;

--homepage
--authUserFeed
--get unread notifications
SELECT "notification".id, "notification"."date", "notification".vote_id, "notification".comment_id, "notification".follower_id
FROM "notification"
WHERE "notification".receiver=$userid AND "notification".is_read = false
ORDER BY DESC "notification"."date";

--get all notifications
SELECT "notification".id, "notification"."date", "notification".vote_id, "notification".comment_id, "notification".follower_id
FROM "notification"
WHERE "notification".receiver=$userid
ORDER BY DESC "notification"."date";

--get vote notifications
SELECT "notification".id, "notification"."date", "notification".vote_id
FROM "notification"
WHERE "notification".receiver=$userid AND "notification".follower_id = NULL AND "notification".comment_id = NULL
ORDER BY DESC "notification"."date";

--get follow notifications
SELECT "notification".id, "notification"."date", "notification".follower_id
FROM "notification"
WHERE "notification".receiver=$userid AND "notification".vote_id = NULL AND "notification".comment_id = NULL
ORDER BY DESC "notification"."date";

--get comment notification
SELECT "notification".id, "notification"."date", "notification".comment_id
FROM "notification"
WHERE "notification".receiver=$userid AND "notification".vote_id = NULL AND "notification".follower_id = NULL
ORDER BY DESC "notification"."date";



--Get posts from followed user's
SELECT post.id, post."datetime", user.name, post.body, post.header, post.title, category.name
FROM post, user, category, follow
WHERE follow.follower=$userid AND follow.followed=post.user_id AND post.category=category.id AND post.user_id=user.id
ORDER BY DESC post.datetime;

--get posts from followed categories
SELECT post.id, post."datetime", user.name, post.body, post.header, post.title, category.name
FROM post, user, category, follow_category
WHERE follow_category.user_id=$userid AND follow_category.category_id=post.category AND post.category=category.id AND post.user_id=user.id
ORDER BY DESC post.datetime;

--get more recent posts
SELECT post.id, post."datetime", user.name, post.body, post.header, post.title, category.name
FROM post, user, category
WHERE post.category=category.id AND post.user_id=user.id
ORDER BY DESC post.datetime;

--get posts from category
SELECT post.id, post."datetime", user.name, post.body, post.header, post.title, category.name
FROM post, user, category
WHERE post.category=category.id AND category.id=$selectedCategoryID AND post.user_id=user.id
ORDER BY DESC post.datetime;


--editPostPage
--get info to be edited 
SELECT post.id, post.body, post.header, post.title, category.name
FROM post, user, category
WHERE post.id=$editedPostID AND post.category=category.id AND post.user_id=$ownerID
ORDER BY DESC post.datetime;

--fullPostPageAdmin
--fullPostPage
--get full post
SELECT post.id, post."datetime", user.name, post.body, post.header, post.title, category.name
FROM post, user, category
WHERE post.category=category.id AND post.id=$selectedPostID AND post.user_id=user.id;

--get post references
SELECT reference.name
FROM reference, post_reference
WHERE reference.id = post_reference.reference_id AND post_reference.post_id=$selectedPostID;

--get comments from post
SELECT comment.id, comment.date, user.name, comment.body
FROM post, user, comment
WHERE comment.post_id=$selectedPostID AND comment.user_id=user.id
ORDER BY DESC comment.date;


--login
--get Auth user
SELECT *
FROM user
WHERE user.username=$username AND user.password=$password AND user.state="Active";


--myProfilePage
--get personal info
SELECT user.username, user.name, user.photo
FROM user
WHERE user.id=$userID;

--get Own Posts
SELECT post.id, post."datetime", post.header, post.title, user.name, category.name
FROM post, user, category
WHERE post.category=category.id AND post.user_id=$userID
ORDER BY DESC post.datetime;

--get Saved
SELECT post.id, post."datetime", post.header, post.title, user.name, category.name
FROM post, user, category, saved_post
WHERE saved_post.post_id = post.id AND post.category=category.id AND saved_post.user_id = $userID
ORDER BY DESC post.datetime;

--get Upvotes
SELECT post.id, post."datetime", post.header, post.title, user.name, category.name
FROM post, user, category, post_vote
WHERE post.category=category.id AND post.user_id=user.id AND post_vote.post_id=post.id AND post_vote.user_id=$userID AND post_vote.is_up=true
ORDER BY DESC post.datetime;


--otherProfile
--getOthersInfo
SELECT user.username, user.name, user.photo
FROM user
WHERE user.id=$otherUserID;

--get Others Posts
SELECT post.id, post."datetime", post.header, post.title, user.name, category.name
FROM post, user, category
WHERE post.category=category.id AND post.user_id=$otherUserID
ORDER BY DESC post.datetime;

--get Others Upvotes
SELECT post.id, post."datetime", post.header, post.title, user.name, category.name
FROM post, user, post_vote
WHERE post.category=category.id AND post.user_id=user.id AND post_vote.post_id=post.id AND post_vote.user_id=$otherUserID AND post_vote.is_up=true
ORDER BY DESC post.datetime;

--userManager
--get All users
SELECT user.username, user.name, user.photo
FROM user;

--get all suspended users
SELECT user.username, user.name, user.photo
FROM user
WHERE user.user_state="Suspended";

--get all banned users
SELECT user.username, user.name, user.photo
FROM user
WHERE user.user_state="Banned";

--get all active users
SELECT user.username, user.name, user.photo
FROM user
WHERE user.user_state="Active";


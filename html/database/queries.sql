-- adminDashboard

-- Get all report's info*
SELECT report.id, report.date, "user".name, report.comment_id, report.post_id
FROM report, "user"
WHERE report.user_id = "user".id;

-- Get all report's info (not answered reports)*
SELECT report.id, report.date, "user".name, report.comment_id, report.post_id
FROM report, "user"
WHERE report.state='NotAnswered' AND report.user_id = "user".id; 

-- get all post reports*
SELECT report.id, report.state, report.date, "user".name, report.post_id, report.admin_id
FROM report, "user"
WHERE report.user_id = "user".id AND report.comment_id IS NULL
LIMIT $limit OFFSET $offset;

-- get all post reports (unread)*
SELECT report.id, report.date, "user".name, report.post_id, report.admin_id
FROM report, "user"
WHERE report.state='NotAnswered' AND report.user_id = "user".id AND report.comment_id IS NULL
LIMIT $limit OFFSET $offset;

--get comment reports*
SELECT report.id, report.state, report.date, "user".name, report.comment_id, report.admin_id
FROM report, "user"
WHERE report.user_id = "user".id AND report.post_id IS NULL
LIMIT $limit OFFSET $offset;

--get comment reports (unread)*
SELECT report.id, report.state, report.date, "user".name, report.comment_id, report.admin_id
FROM report, "user"
WHERE report.state='NotAnswered' AND report.user_id = "user".id AND report.post_id IS NULL
LIMIT $limit OFFSET $offset;

--get number of reports (post)*
SELECT report.post_id, COUNT(*)
FROM report
WHERE report.comment_id IS NULL
GROUP BY report.post_id;

--get number of reports (comment)*
SELECT report.comment_id, COUNT(*)
FROM report
WHERE report.post_id IS NULL
GROUP BY report.comment_id;

--get "user" by ID (util)*
SELECT *
FROM "user"
WHERE "user".id = $userid;

--get post by ID (util)*
SELECT *
FROM post
WHERE post.id=$postID;

--homepage
--authUserFeed
--get unread notifications*
SELECT "notification".id, "notification"."date", "notification".vote_id, "notification".comment_id, "notification".follower_id
FROM "notification"
WHERE "notification".receiver=$userid AND "notification".is_read = FALSE
ORDER BY "notification"."date" DESC
LIMIT $limit OFFSET $offset;

--TODO get it going
--get follow and comment notifications* confirmar o que está a null no php 
SELECT "notification".id, 
    "notification"."date", 
    "notification".comment_id, "comment".user_id AS user_who_commented, "comment".datetime, "comment".body, "comment".post_id AS post_commented,
    "notification".follower_id, "user".username,
FROM "notification" FULL JOIN "comment" FULL JOIN "user"
WHERE "notification".receiver=$userid 
    AND "notification".comment_id="comment".id 
    AND "notification".follower_id="user".id
    AND "notification".vote_id = NULL 
ORDER BY DESC "notification"."date"
LIMIT $limit OFFSET $offset;

--get vote notifications all in one
SELECT "notification".id, "notification"."date",
    "notification".vote_id, 
    "post_vote".is_up, 
    "post_vote".post_id AS post_voted, 
    "post_vote".user_id AS user_who_voted
FROM "notification" FULL OUTER JOIN "post_vote"
ON "notification".vote_id = post_vote.id
WHERE "notification".receiver=5
    AND "notification".follower_id = NULL 
    AND "notification".comment_id = NULL  
    AND "notification".vote_id = "post_vote".id 
ORDER BY "notification"."date" DESC
GROUP BY "post_vote".post_id
LIMIT $limit OFFSET $offset;


--Get posts from followed "user"'s*
SELECT post.id, post."datetime", "user".name, post.body, post.header, post.title, category.name, post.upvotes, post.downvotes
FROM post, "user", category, follow
WHERE follow.follower=$userid AND follow.followed=post.user_id AND post.category=category.id AND post.user_id="user".id
ORDER BY post.datetime DESC;
LIMIT $limit OFFSET $offset;

--get posts from followed categories*
SELECT post.id, post."datetime", "user".name, post.body, post.header, post.title, category.name, post.upvotes, post.downvotes
FROM post, "user", category, follow_category
WHERE follow_category.user_id = $userid AND follow_category.category_id = post.category AND post.category = category.id AND post.user_id = "user".id AND follow_category.category_id = category.id
ORDER BY post."datetime" DESC
LIMIT $limit OFFSET $offset;

--get more recent posts*
SELECT post.id, post."datetime", "user".name, post.body, post.header, post.title, category.name, post.upvotes, post.downvotes
FROM post, "user", category
WHERE post.category = category.id AND post.user_id = "user".id
ORDER BY post."datetime" DESC
LIMIT $limit OFFSET $offset;

--get posts from category*
SELECT post.id, post."datetime", "user".name, post.body, post.header, post.title, category.name, post.upvotes, post.downvotes
FROM post, "user", category
WHERE post.category = category.id AND category.id = $selectedCategoryID AND post.user_id = "user".id
ORDER BY post.datetime DESC
LIMIT $limit OFFSET $offset;


--editPostPage
--get info to be edited* 
SELECT post.id, post.body, post.header, post.title, category.name
FROM post, category
WHERE post.id = $postid AND post.category = category.id AND post.user_id =$userid
;

--fullPostPageAdmin
--fullPostPage
--get full post*
SELECT post.id, post."datetime", "user".name, post.body, post.header, post.title, category.name, post.upvotes, post.downvotes
FROM post, "user", category
WHERE post.category = category.id AND post.id = $selectedPostID AND post.user_id = "user".id;

--get post references*
SELECT reference.name
FROM reference, post_reference
WHERE reference.id = post_reference.reference_id AND post_reference.post_id = $selectedPostID;

--get comments from post*
SELECT comment.id, comment."datetime", "user".name, comment.body
FROM post, "user", comment
WHERE comment.post_id = $selectedPostID AND comment.user_id = "user".id AND post.id=$selectedPostID
ORDER BY comment."datetime" DESC
LIMIT $limit OFFSET $offset;


--login
--get Auth user*
SELECT *
FROM "user"
WHERE "user".username = $username AND "user".password = $password AND "user".state = 'Active';


--myProfilePage
--get personal info*
SELECT "user".username, "user".name, "user".photo
FROM "user"
WHERE "user".id = $userID;

--get User Posts*
SELECT post.id, post."datetime", post.header, post.title, "user".name, category.name, post.upvotes, post.downvotes
FROM post, "user", category
WHERE post.category = category.id AND post.user_id = $userID AND  "user".id=$userID
ORDER BY post."datetime" DESC
LIMIT $limit OFFSET $offset;

--get Saved*
SELECT post.id, post."datetime", post.header, post.title, "user".name, category.name, post.upvotes, post.downvotes
FROM post, "user", category, saved_post
WHERE saved_post.post_id = post.id AND post.category=category.id AND saved_post.user_id = $userID AND "user".id=post.user_id
ORDER BY post."datetime" DESC
LIMIT $limit OFFSET $offset;

--get Upvotes*
SELECT post.id, post."datetime", post.header, post.title, "user".name, category.name, post.upvotes, post.downvotes
FROM post, "user", category, post_vote
WHERE post.category = category.id AND post.user_id = "user".id AND post_vote.post_id = post.id AND post_vote.user_id = $userID AND post_vote.is_up=TRUE
ORDER BY post."datetime" DESC
LIMIT $limit OFFSET $offset;


--otherProfile
--getOthersInfo*
SELECT "user".username, "user".name, "user".photo
FROM "user"
WHERE "user".id = $otherUserID;


--userManager
--get All users*
SELECT "user".username, "user".name, "user".photo
FROM "user"
LIMIT $limit OFFSET $offset;

--get all suspended users*
SELECT "user".username, "user".name, "user".photo
FROM "user"
WHERE "user".state = 'Suspended'
LIMIT $limit OFFSET $offset;

--get all banned users*
SELECT "user".username, "user".name, "user".photo
FROM "user"
WHERE "user".state = 'Banned'
LIMIT $limit OFFSET $offset;

--get all active users*
SELECT "user".username, "user".name, "user".photo
FROM "user"
WHERE "user".state = 'Active'
LIMIT $limit OFFSET $offset;
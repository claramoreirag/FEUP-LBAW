
CREATE INDEX post_category ON post USING hash (category); 

CREATE INDEX post_user_id ON post USING hash (user_id);  

CREATE INDEX post_vote_value ON post_vote USING hash (is_up);

CREATE INDEX comment_info ON comment USING hash (post_id, user_id);

CREATE INDEX get_notification ON "notification" USING hash (receiver);

CREATE INDEX get_unanswered_reports ON report USING hash (state, user_id);


-- Full-text Search Indices

CREATE INDEX post_search_index ON post
USING GIST ((setweight(to_tsvector('english', title),'A') || 
       setweight(to_tsvector('english', header), 'B')|| 
       setweight(to_tsvector('english', body), 'C')));


CREATE INDEX user_search_index ON user
USING GIST ((setweight(to_tsvector('english', username),'A') || 
       setweight(to_tsvector('english', name), 'B')));


-- Querys 

SELECT title
FROM post
WHERE to_tsvector('english', title || ' ' || body) @@ plainto_tsquery('english', 'climate neutral');

SELECT username
FROM "user"
WHERE  to_tsvector('english', username || ' ') @@ plainto_tsquery('english', 'marianaramos');

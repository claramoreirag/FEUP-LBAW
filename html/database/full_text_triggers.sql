CREATE INDEX post_search_index ON post
USING GIST ((setweight(to_tsvector('english', title),'A') || 
       setweight(to_tsvector('english', header), 'B')|| setweight(to_tsvector('english', body), 'C')));


CREATE INDEX user_search_index ON user
USING GIST ((setweight(to_tsvector('english', username),'A') || 
       setweight(to_tsvector('english', name), 'B')));
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS follow_category CASCADE;
DROP TABLE IF EXISTS reference CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS saved_post CASCADE;
DROP TABLE IF EXISTS post_reference CASCADE;
DROP TABLE IF EXISTS post_vote CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS follow CASCADE;
DROP TABLE IF EXISTS "notification" CASCADE;
DROP TABLE IF EXISTS "user" CASCADE;


DROP TYPE IF EXISTS user_state;
DROP TYPE IF EXISTS report_state;

CREATE TYPE user_state AS ENUM ('Banned', 'Suspended', 'Active');
CREATE TYPE report_state AS ENUM ('Accepted', 'Deleted', 'SuspendedUser', 'BanedUser', 'NotAnswered');

CREATE TABLE "user"(
    id SERIAL PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    photo TEXT,
    state user_state NOT NULL, 
    is_admin BOOLEAN NOT NULL
);

CREATE TABLE category(
  id SERIAL PRIMARY KEY,
  name text UNIQUE NOT NULL 
);

CREATE TABLE follow_category(
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    category_id INTEGER NOT NULL REFERENCES category(id),
    PRIMARY KEY (user_id, category_id)
);

CREATE TABLE reference(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE post(
    id SERIAL PRIMARY KEY,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    user_id INTEGER REFERENCES "user"(id) NOT NULL,
    title TEXT NOT NULL,
    header TEXT NOT NULL,
    body TEXT NOT NULL,
    category INTEGER REFERENCES category(id) NOT NULL,
    upvotes int NOT NULL DEFAULT 0,
    downvotes int NOT NULL DEFAULT 0
);

CREATE TABLE saved_post(
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id),
    PRIMARY KEY (user_id, post_id)
);

CREATE TABLE post_reference(
    post_id INTEGER REFERENCES post(id),
    reference_id INTEGER REFERENCES reference(id),
    PRIMARY KEY(post_id, reference_id)
);


CREATE TABLE post_vote (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id),
    UNIQUE(user_id,post_id),
    is_up BOOLEAN NOT NULL
);
CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id) ON DELETE CASCADE,
    body text,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    comment_id INTEGER REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    state report_state NOT NULL,
    comment_id INTEGER REFERENCES comment(id) ON DELETE CASCADE,
    post_id INTEGER REFERENCES post(id) ON DELETE CASCADE,
    admin_id INTEGER REFERENCES "user"(id) ON DELETE CASCADE,
    UNIQUE(user_id,comment_id),
    UNIQUE(user_id,post_id)
);

CREATE TABLE follow(
    follower INTEGER NOT NULL REFERENCES "user"(id),
    followed INTEGER NOT NULL REFERENCES "user"(id),
    PRIMARY KEY (follower, followed)
);


CREATE TABLE "notification"(
  id SERIAL PRIMARY KEY,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  is_read BOOLEAN,
  receiver INTEGER REFERENCES "user"(id),
  vote_id INTEGER REFERENCES post_vote(id), 
  comment_id INTEGER REFERENCES comment(id),
  follower_id INTEGER REFERENCES "user"(id)
);
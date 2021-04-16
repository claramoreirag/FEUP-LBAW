
CREATE TYPE user_state AS ENUM ENUM ('Banned', 'Suspended', 'Active');
CREATE TYPE report_state AS ENUM ('Accepted', 'Deleted', 'SuspendedUser', 'BanedUser', 'NotAnswered');


CREATE TABLE user(
    id INTEGER REFERENCES user(id) PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
    name TEXT NOT NULL,
    email UNIQUE NOT NULL,
    photo TEXT,
    state user_state NOT NULL CHECK, 
    is_admin BOOLEAN NOT NULL
);

CREATE TABLE post(
    id INTEGER PRIMARY KEY,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    user_id INTEGER REFERENCES user(id) NOT NULL,
    title TEXT NOT NULL,
    header TEXT NOT NULL,
    body TEXT NOT NULL,
    category INTEGER REFERENCES category(id) NOT NULL
    upvotes int NOT NULL DEFAULT 0,
    downvotes int NOT NULL DEFAULT 0,
);

CREATE TABLE saved_post(
    user_id INTEGER REFERENCES user (id),
    post_id INTEGER REFERENCES post (id),
    PRIMARY KEY (user_id, post_id)
);

CREATE TABLE follow_category(
    user_id INTEGER NOT NULL REFERENCES user(id),
    category_id INTEGER NOT NULL REFERENCES category(id),
    PRIMARY KEY (user_id, category_id)
);

CREATE TABLE post_reference(
    post_id INTEGER REFERENCES post (id),
    reference_id INTEGER REFERENCES reference(id)
    PRIMARY KEY (post_id, reference_id)
);

CREATE TABLE post_vote (
    id SERIAL PRIMARY KEY,
    user_id INTEGER UNIQUE REFERENCES user (id),
    post_id INTEGER UNIQUE REFERENCES post (id),
    is_up BOOLEAN NOT NULL
);

CREATE TABLE comment (
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES user (id),
    post_id INTEGER REFERENCES post (id) ON DELETE CASCADE,
    body text,
    "datetime" DateTime DEFAULT Now,
    comment_id REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE report (
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES user (id),
    date DateTime,
    state report_state NOT NULL,
    comment_id REFERENCES comment(id) ON DELETE CASCADE,
    post_id REFERENCES post(id) ON DELETE CASCADE,
    admin_id REFERENCES user(id) ON DELETE CASCADE
);

CREATE TABLE follow(
    follower INTEGER NOT NULL REFERENCES user(id),
    followed INTEGER NOT NULL REFERENCES user(id)
);


CREATE TABLE category(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE reference(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE "notification"(
  id SERIAL PRIMARY KEY,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  is_read BOOLEAN,
  receiver INTEGER REFERENCES user(id),
  vote_id REFERENCES post_vote(id), 
  comment_id REFERENCES comment(id),
  follower_id REFERENCES user(id)
);

CREATE TABLE saved_post(
    user_id INTEGER REFERENCES user(id),
    post_id INTEGER REFERENCES post(id),
    PRIMARY KEY (user_id, post_id)
);

CREATE TABLE post_reference(
    post_id INTEGER REFERENCES post(id),
    reference_id INTEGER REFERENCES reference(id)
    PRIMARY KEY (post_id, reference_id)
);


CREATE TABLE follow_category(
    user_id INTEGER NOT NULL REFERENCES user(id),
    category_id INTEGER NOT NULL REFERENCES category(id),
    PRIMARY KEY (user_id, category_id)
);
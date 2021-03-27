
CREATE TYPE user_state AS ENUM ENUM ('Banned', 'Suspended', 'Active');
CREATE TYPE report_state AS ENUM ('Accepted', 'Deleted', 'SuspendedUser', 'BanedUser');


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
    user INTEGER REFERENCES user(id) NOT NULL,
    body TEXT NOT NULL,
    category INTEGER REFERENCES category(id) NOT NULL
);

CREATE TABLE post_vote (
    id_user INTEGER REFERENCES user (id),
    id_post INTEGER REFERENCES post (id),
    is_up BOOLEAN NOT NULL,
    PRIMARY KEY (id_user, id_post)
);

CREATE TABLE comment (
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES user (id),
    post_id INTEGER REFERENCES post (id),
    body text,
    "datetime" DateTime,
    comment_id REFERENCES comment(id)
);

CREATE TABLE report (
    id INTEGER PRIMARY KEY,
    id_user INTEGER REFERENCES user (id),
    date DateTime,
    state report_state NOT NULL,
    comment_id REFERENCES comment(id),
    post_id REFERENCES post(id),
    admin_id REFERENCES user(id)
);

CREATE TABLE follow(
    follower INTEGER NOT NULL REFERENCES authenticated_user(id),
    followed INTEGER NOT NULL REFERENCES authenticated_user(id)
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
  receiver INTEGER REFERENCES authenticated_user (id),
  vote_id REFERENCES post_vote(post_id), /*??*/
  comment_id REFERENCES comment(id),
  follower_id REFERENCES user(id)
);






CREATE TYPE vote_type AS ENUM ('Up', 'Down');
CREATE TYPE user_state AS ENUM ENUM ('Banned', 'Suspended', 'Active');
CREATE TYPE report_state AS ENUM ('Accepted', 'Deleted', 'SuspendedUser', 'BanedUser');
CREATE TYPE notification_state AS ENUM ('NotRead', 'Read');


CREATE TABLE user(
    id INTEGER PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
);

CREATE TABLE authenticated_user(
    id INTEGER REFERENCES user(id) PRIMARY KEY,
    name TEXT NOT NULL,
    email UNIQUE NOT NULL,
    photo TEXT,
    state user_state NOT NULL CHECK
);

CREATE TABLE admin_user(
    id INTEGER REFERENCES user(id) PRIMARY KEY
);

CREATE TABLE post(
    id INTEGER PRIMARY KEY,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    user INTEGER REFERENCES user(id) NOT NULL,
    body TEXT NOT NULL,
    category INTEGER REFERENCES category(id) NOT NULL
);

CREATE TABLE post_vote (
    id_user INTEGER REFERENCES user (id),
    id_post INTEGER REFERENCES post (id),
    state vote_type NOT NULL
);

CREATE TABLE comment (
    id INTEGER PRIMARY KEY,
    id_user INTEGER REFERENCES user (id),
    id_post INTEGER REFERENCES post (id),
    body text,
    date DateTime,
);

CREATE TABLE report (
    id INTEGER PRIMARY KEY,
    id_user INTEGER REFERENCES user (id),
    date DateTime,
    state report_state NOT NULL
);

CREATE TABLE comment report (
    id INTEGER REFERENCES report (id),
    id_comment INTEGER REFERENCES comment (id),
);

CREATE TABLE notification_follow(
    id INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
    follow_id INTEGER NOT NULL REFERENCES follow
);

CREATE TABLE notification_comment(
    id INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
    comment_id INTEGER NOT NULL REFERENCES comment
);

CREATE TABLE notification_vote(
    id INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
    vote_id INTEGER NOT NULL REFERENCES post_report
);

CREATE TABLE follow(
    id SERIAL PRIMARY KEY,
    follower INTEGER NOT NULL REFERENCES authenticated_user(id),
    followed INTEGER NOT NULL REFERENCES authenticated_user(id)
);

CREATE TABLE reply(
    reply INTEGER PRIMARY KEY REFERENCES comment(id) ON UPDATE CASCADE,
    comment INTEGER REFERENCES comment(id)
);

CREATE TABLE handle_report(
    report_id INTEGER PRIMARY KEY REFERENCES report(id) ON UPDATE CASCADE
    admin_id INTEGER REFERENCES admin_user(id)
);

CREATE TABLE post_report(
  id INTEGER PRIMARY KEY REFERENCES report (id) ON UPDATE CASCADE,
  id INTEGER REFERENCES post (id)
);

CREATE TABLE category(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE reference(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE notification(
  id SERIAL PRIMARY KEY,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  TYPE notification_state NOT NULL,
  receiver INTEGER REFERENCES authenticated_user (id)
);


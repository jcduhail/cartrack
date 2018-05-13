CREATE TABLE users(
user_id INTEGER PRIMARY KEY AUTOINCREMENT,
username VARCHAR(50),
password VARCHAR(300),
name VARCHAR(200),
email VARCHAR(300));

insert into users (username,password,name,email) values ('klaud9','dcc1a2beea96967e76e57e3173ea1b1fcf87daf528c9d0377da0d606927e953a','klaud9','email@gmail.com');

CREATE TABLE notes (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    note VARCHAR NOT NULL
);

insert into notes (note) values('one');
insert into notes (note) values('two');
insert into notes (note) values('three');
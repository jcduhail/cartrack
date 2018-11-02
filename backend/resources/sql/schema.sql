CREATE TABLE users(
user_id INTEGER PRIMARY KEY AUTOINCREMENT,
username VARCHAR(50),
password VARCHAR(300),
name VARCHAR(200),
email VARCHAR(300));

insert into users (username,password,name,email) values ('cartrack','76e6094efe06f6cb4562a04313e1f730672ff20a4fb0095f147f7594f3a343ae','klaud9','email@gmail.com');
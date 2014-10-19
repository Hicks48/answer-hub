CREATE TABLE users
(
	id int NOT NULL UNIQUE AUTO_INCREMENT,
	username varchar(50) NOT NULL UNIQUE,
	password varchar(20) NOT NULL,
	admin bit NOT NULL,
	email varchar(100) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE questions
(
	id int NOT NULL UNIQUE AUTO_INCREMENT,
	title varchar(100) NOT NULL,
	question text NOT NULL,
	asked_by int NOT NULL,
	time_asked timestamp NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(asked_by) REFERENCES users(id)
);

CREATE TABLE answers
(
	id int NOT NULL UNIQUE AUTO_INCREMENT,
	question_id int NOT NULL,
	answer_by int NOT NULL,
	answer text NOT NULL,
	time_answered timestamp NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(answer_by) REFERENCES users(id),
	FOREIGN KEY(question_id) REFERENCES questions(id)
);


CREATE TABLE tags
(
	id int NOT NULL UNIQUE AUTO_INCREMENT,
	name varchar(25) UNIQUE NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE questions_to_tags
(
	question_id int NOT NULL,
	tag_id int NOT NULL,
	FOREIGN KEY(question_id) REFERENCES questions(id),
	FOREIGN KEY(tag_id) REFERENCES tags(id)
);

CREATE TABLE ratings
(
	id int NOT NULL UNIQUE AUTO_INCREMENT,
	question_id int NOT NULL,
	rating int NOT NULL,
	rated_by int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(question_id) REFERENCES questions(id),
	FOREIGN KEY(rated_by) REFERENCES users(id)
);
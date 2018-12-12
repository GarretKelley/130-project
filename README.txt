csci130 project by david and garret

the following is a setup for the database.

first, making a user account for the database.
	account information
 	username: csci130
	hostname: localhost
 	password: 123456
 	scroll down and click on 'check all' next to global privileges

second, creating the database and tables. 
name: 130_project

3 tables
CREATE TABLE Players (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lastname varchar(255) NOT NULL,
    firstname varchar(255) NOT NULL,
    age varchar(255) NOT NULL,
    gender varchar(255) NOT NULL,
    location varchar(255) NOT NULL,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL
);

CREATE TABLE Games (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    player_id INT UNSIGNED NOT NULL,
	level_mode VARCHAR(64) NOT NULL,
	level_sizze TINYINT UNSIGNED NOT NULL,
    duration INT UNSIGNED NOT NULL,
    score FLOAT UNSIGNED NOT NULL,
    FOREIGN KEY (player_id) REFERENCES Players(ID)
);
CREATE TABLE Levels (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    size BOOL NOT NULL,
    small CHAR(49),
    large CHAR(169)
);
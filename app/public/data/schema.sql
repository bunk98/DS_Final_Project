CREATE DATABASE IF NOT EXISTS msisdb;
USE msisdb;

DROP TABLE IF EXISTS referee;
CREATE TABLE referee (
	id int PRIMARY KEY AUTO_INCREMENT ,
    first_name varchar(24),
    last_name varchar(48),
    age int,
    dob date,
    grade varchar(24),
    rating int
);

INSERT INTO referee (id, first_name, last_name, age, dob, grade, rating) VALUES 
(1, 'Alex', 'Lopez', 34, '1987-12-11','A',3),
(2, 'Bipin', 'Prabhakar', 32, '1989-01-02','B',2),
(3, 'Alex', 'Bruce', 26, '1995-03-01','A',4),
(4, 'Tom', 'Gregory', 25, '1996-04-04','A',4),
(5, 'Bala', 'M', 28, '1993-10-11','C',2);


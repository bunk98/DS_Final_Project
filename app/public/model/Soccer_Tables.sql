CREATE TABLE Referee (
refereeID INT(6) AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
grade VARCHAR(50),
rating VARCHAR(50),
dob DATE NOT NULL
);

CREATE TABLE User (
userID INT(6) AUTO_INCREMENT PRIMARY KEY,
user_role VARCHAR(30) NOT NULL,
user_password VARCHAR(30) NOT NULL
);

CREATE TABLE Game (
gameID INT(6) AUTO_INCREMENT PRIMARY KEY,
field VARCHAR(30) NOT NULL,
game_name VARCHAR(30) NOT NULL,
game_time TIME NOT NULL
);

CREATE TABLE Ref_Game (
rg_status VARCHAR(30) NOT NULL,
postion VARCHAR(30) NOT NULL,
refereeID INT(6) NOT NULL,
FOREIGN KEY (refereeID) REFERENCES Referee(refereeID),
gameID INT(6) NOT NULL,
FOREIGN KEY (gameID) REFERENCES Game(gameID)
);

insert into Referee (firstname, lastname, grade, rating, dob) values ('Adda', 'McElwee', 'A', 69, '2018-12-09');
insert into Referee (firstname, lastname, grade, rating, dob) values ('Katey', 'Abbis', 'B', 2, '2018-01-29');
insert into Referee (firstname, lastname, grade, rating, dob) values ('Rubia', 'Waith', 'C', 56, '2020-10-26');
insert into Referee (firstname, lastname, grade, rating, dob) values ('Jody', 'Pawlik', 'B', 60, '2021-01-30');
insert into Referee (firstname, lastname, grade, rating, dob) values ('Tiffie', 'Guthrie', 'A', 3, '2019-01-02');
insert into Referee (firstname, lastname, grade, rating, dob) values ('RRR', 'GuWWWWthrie', 'A', 3, '2019-01-02');

insert into Game (field, game_name, game_time) values ('Field1', 'birds vs. dogs', '10:00:00');
insert into Game (field, game_name, game_time) values ('Field2', 'dogs vs. cats', '10:00:00');
insert into Game (field, game_name, game_time) values ('Field3', 'moose vs. dogs', '10:00:00');
insert into Game (field, game_name, game_time) values ('Field1', 'walrus vs. cats', '10:00:00');
insert into Game (field, game_name, game_time) values ('Field2', 'walrus vs. birds', '10:00:00');

insert into Ref_Game (rg_status, position, refereeID, gameID) values ('Assigned', 'Line judge', 1, 3);
insert into Ref_Game (rg_status, position, refereeID, gameID) values ('Tenative', 'Goal line', 1, 2);
insert into Ref_Game (rg_status, position, refereeID, gameID) values ('Accepted', 'Mid line', 2, 3);
insert into Ref_Game (rg_status, position, refereeID, gameID) values ('Accepted', 'Goal line', 4, 1);
insert into Ref_Game (rg_status, position, refereeID, gameID) values ('Assigned', 'Mid line', 5, 4);

SELECT refereeID, gameID FROM Ref_Game


SELECT refereeID, gameID from Referee
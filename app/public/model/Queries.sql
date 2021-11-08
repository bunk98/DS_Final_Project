Q1:

SELECT CONCAT(r.firstname, " ", r.lastname) as referee, 
    g.game_name as game, 
    rg.rg_status as rg_status, 
    rg.position as position, 
    rg.rgID as rgID,
    g.game_date as g_date
FROM Ref_Game as rg 
JOIN Referee as r on rg.refereeID = r.refereeID 
JOIN Game as g on rg.gameID = g.gameID
WHERE rg.refereeID = 1
AND g.game_date BETWEEN "2021-11-25" AND "2022-1-1";

Q2:

SELECT CONCAT(r.firstname, " ", r.lastname) as referee, 
    g.game_name as game, 
    rg.rg_status as rg_status, 
    rg.position as position, 
    rg.rgID as rgID,
    g.game_date as g_date
FROM Ref_Game as rg 
JOIN Referee as r on rg.refereeID = r.refereeID 
JOIN Game as g on rg.gameID = g.gameID
WHERE rg.rg_status = "Unassigned"
AND g.game_date > CURRENT_DATE()
GROUP BY game;

Q3:

SELECT COUNT(*) as cnt
FROM Ref_Game as rg 
JOIN Referee as r on rg.refereeID = r.refereeID 
JOIN Game as g on rg.gameID = g.gameID
WHERE rg.rg_status = "Unassigned"
AND g.game_date > CURRENT_DATE();


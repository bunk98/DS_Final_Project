<?php
// require 'common.php';
require 'class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

// Step 2: Create & run the query
$sql = 'SELECT CONCAT(r.firstname, " ", r.lastname) as referee, g.game_name as game, rg.rg_status as rg_status, rg.position as position, rg.rgID as rgID  FROM Ref_Game as rg JOIN Referee as r on rg.refereeID = r.refereeID JOIN Game as g on rg.gameID = g.gameID';
$vars = [];

 if (isset($_GET['student'])) {
   // This is an example of a parameterized query
   $sql = 'SELECT CONCAT(r.firstname, " ", r.lastname) as referee, g.game_name as game, rg.rg_status as rg_status, rg.position as position, rg.rgID as rgID  FROM Ref_Game as rg JOIN Referee as r on rg.refereeID = r.refereeID JOIN Game as g on rg.gameID = g.gameID WHERE rg.gameID = ?';
   $vars = [ $_GET['student'] ];
 }

$stmt = $db->prepare($sql);
$stmt->execute($vars);

$offer = $stmt->fetchAll();

// Step 3: Convert to JSON
$json = json_encode($offer, JSON_PRETTY_PRINT);

// Step 4: Output
header('Content-Type: application/json');
echo $json;
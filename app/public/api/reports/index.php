<?php
// require 'common.php';
require 'class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

// Step 2: Create & run the query
$sql = 'SELECT CONCAT(r.firstname, " ", r.lastname) as referee, 
g.game_name as game, 
rg.rg_status as rg_status, 
rg.position as position, 
rg.rgID as rgID,
g.game_date as g_date
FROM Ref_Game as rg 
JOIN Referee as r on rg.refereeID = r.refereeID 
JOIN Game as g on rg.gameID = g.gameID
WHERE rg.refereeID = ?
AND g.game_date BETWEEN "2021-11-25" AND "2022-1-1"';
$vars = [$_POST['refereeID']];

// if (isset($_GET['guid'])) {
//   // This is an example of a parameterized query
//   $sql = 'SELECT * FROM Patient WHERE patientGuid = ?';
//   $vars = [ $_GET['guid'] ];
// }

$stmt = $db->prepare($sql);
$stmt->execute($vars);

$referee = $stmt->fetchAll();

// Step 3: Convert to JSON
$json = json_encode($referee, JSON_PRETTY_PRINT);

// Step 4: Output
header('Content-Type: application/json');
echo $json;
?>
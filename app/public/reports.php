<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> 

    <!-- Adding Vue js-->

    <script src="https://unpkg.com/vue@next"></script>
    

    <div class="logo-image">
        <img src="img/logo.png" class="img-fluid" >    
  </div>
  <span class="MyText">INDIANA SOCCER REFEREE ASSOCIATION</span>


  <!-- <a href="#" class="MyLink"><img src="C:\Users\asha0\OneDrive\Documents\GitHub\DS_Final_Project\images\logo.png" /><span class="MyLinkText">INDIANA SOCCER REFERER ASSOCIATION</span></a> -->
  

  </head>
  <body>

  
    <nav class="navbar sticky-top navbar-expand-lg">
        
      <div class="container-fluid">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
          <!-- <span class="navbar-toggler-icon"></span> -->
          <span class="" role="button" ><i class="fa fa-bars" aria-hidden="true" style="color:#e6e6ff"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " href="index.html">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="referee.html">REFEREE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="games.html">GAMES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assignments.html">ASSIGNMENTS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="details.html">REFEREE DETAILS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="details2.html">GAME DETAILS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="reports.php">REPORTS</a>
            </li>
            
          </ul>

          
        </div>

        
        
      </div>

  
    </nav>



    
<br>

<main>
  <br>
  <br>
  <h1  class="text-center">Report Display:</h1>
  <br>
  <?php
// Turn off all error reporting
error_reporting(0);
?>

  <center>
  <?php
// require 'common.php';
require 'class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

if (isset($_POST['formName1'])) {
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
AND g.game_date BETWEEN ? AND ?';
$vars = [$_POST['refereeID'], $_POST['first_date'], $_POST['second_date']];

// if (isset($_GET['guid'])) {
//   // This is an example of a parameterized query
//   $sql = 'SELECT * FROM Patient WHERE patientGuid = ?';
//   $vars = [ $_GET['guid'] ];
// }

$stmt = $db->prepare($sql);
$stmt->execute($vars);

$referee = $stmt->fetchAll();

echo "<table  id='example1' border='1'>
<tr>
<th>Referee</th>
<th>Game</th>
<th>Status</th>
<th>Position</th>
<th>Date</th>
</tr>";

foreach ($referee as $row) {
{
echo "<tr>";
echo "<td>" . $row['referee'] . "</td>";
echo "<td>" . $row['game'] . "</td>";
echo "<td>" . $row['rg_status'] . "</td>";
echo "<td>" . $row['position'] . "</td>";
echo "<td>" . $row['g_date'] . "</td>";
echo "</tr>";
}
echo "</table>";
}
}


if (isset($_POST['formName2'])) {
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
WHERE rg.rg_status = "Unassigned"
AND g.game_date > CURRENT_DATE()
GROUP BY game';
  $vars = [];
  
  // if (isset($_GET['guid'])) {
  //   // This is an example of a parameterized query
  //   $sql = 'SELECT * FROM Patient WHERE patientGuid = ?';
  //   $vars = [ $_GET['guid'] ];
  // }
  
  $stmt = $db->prepare($sql);
  $stmt->execute($vars);
  
  $referee = $stmt->fetchAll();
  
  echo "<table  id='example1' border='1'>
  <tr>
  <th>Referee</th>
  <th>Game</th>
  <th>Status</th>
  <th>Position</th>
  <th>Date</th>
  </tr>";
  
  foreach ($referee as $row) {
  {
  echo "<tr>";
  echo "<td>" . $row['referee'] . "</td>";
  echo "<td>" . $row['game'] . "</td>";
  echo "<td>" . $row['rg_status'] . "</td>";
  echo "<td>" . $row['position'] . "</td>";
  echo "<td>" . $row['g_date'] . "</td>";
  echo "</tr>";
  }
  echo "</table>";
  }
  }

  if (isset($_POST['formName3'])) {
    // Step 2: Create & run the query
    $sql = 'SELECT COUNT(*) as cnt
    FROM Ref_Game as rg 
    JOIN Referee as r on rg.refereeID = r.refereeID 
    JOIN Game as g on rg.gameID = g.gameID
    WHERE rg.rg_status = "Unassigned"
    AND g.game_date > CURRENT_DATE()';
    $vars = [];
    
    // if (isset($_GET['guid'])) {
    //   // This is an example of a parameterized query
    //   $sql = 'SELECT * FROM Patient WHERE patientGuid = ?';
    //   $vars = [ $_GET['guid'] ];
    // }
    
    $stmt = $db->prepare($sql);
    $stmt->execute($vars);
    
    $referee = $stmt->fetchAll();
    
    echo "<table  id='example1' border='1'>
    <tr>
    <th>Count of Games with an Unassigned Referee</th>
    </tr>";
    
    foreach ($referee as $row) {
    {
    echo "<tr>";
    echo "<td>" . $row['cnt'] . "</td>";
    echo "</tr>";
    }
    echo "</table>";
    }
    }

?>

  <br>
  <h1  class="text-center">All games assigned to a referee in a given date range</h1>
  <form action="?" method="post">

  Name: <select id="cars" name="refereeID">
  <option value="0"></option>
  <option value="1">McElwee</option>
  <option value="2">Abbis</option>
  <option value="3">Waith</option>
  <option value="4">Pawlik</option>
  <option value="5">Guthrie</option>
  </select><br>
    Beginning Date: <input type="date" name="first_date"><br>
    End Date: <input type="date" name="second_date"><br>
    <input type="hidden" name="formName1" value="form1"/>
    <input type="submit">
    </form>
    <button onclick="exportTableToCSV('refs_date_range.csv')">Export To CSV File</button>


    <h1  class="text-center">All future games with at least one position of status "Unassigned" </h1>
<br>
<form action="?" method="post">
  <input type="hidden" name="formName2" value="form2"/>
  <input type="submit">
</form>

    <button onclick="exportTableToCSV('unassigned_future.csv')">Export To CSV File</button>

    <h1  class="text-center">Count of future games with at least one position of status "Unassigned" </h1>
<br>
<form action="?" method="post">
  <input type="hidden" name="formName3" value="form3"/>
  <input type="submit">
</form>

    <button onclick="exportTableToCSV('unassigned_future_count.csv')">Export To CSV File</button>


  </center>


<footer class="text-center">
    Indiana Soccer Referee Association |  isrf@iu.edu | 1275 E 10th St Bloomington, IN 47405 | (987)-654-3210

</footer>
    <br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

<script src="js/reports.js"></script>

<script src="js/html2csv.js"></script>

  </body>
</html>
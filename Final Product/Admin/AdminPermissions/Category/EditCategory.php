
<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../../../Login/Homepage.php") ;
    }
    ?>
<head>
  <title>G4U</title>
  <link rel="stylesheet" href="../../../style.css" type="text/css">
  <link rel="stylesheet" href="../../../website.css" type="text/css">
  <link rel="stylesheet" href="Admin.css"  type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../../../Back.png" onclick="goBack()" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../../../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
       </div>


<div class="outputresults">



<?php
$CategoryID = $_GET['CategoryID'];

$host = 'localhost';
$db   = 'g4udatabase';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [    
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    
PDO::ATTR_EMULATE_PREPARES   => false,];

try 
{    
	$pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{     
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sqlQuery = $pdo->prepare('SELECT * FROM category WHERE CategoryID = ?');
$sqlQuery->execute([$CategoryID]);

while($row = $sqlQuery->fetch())
{
?>



	
<br>
<form action="UpdateCategory.php" method="POST" align="center">
<label for="staffid" style="width: 150px">Category ID: </label>
<input type="text" class="form-control" readonly="readonly" name="CategoryID" value="<?php echo $row['CategoryID'];?>" style="width: 300px; display: inline-block"><br>
<label for="staffid" style="width: 150px">Category Name: </label>
<input type="text" class="form-control"  name="CategoryName" value="<?php echo $row['CategoryName'];?>" style="width: 300px; display: inline-block"><br><br>
	
	<input type="submit" class="form-control" value="Update Category" style="width: 300px;" align="center">
</form>

<?php 
}
?>

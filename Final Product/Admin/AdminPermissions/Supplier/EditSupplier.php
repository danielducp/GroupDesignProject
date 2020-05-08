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
        <img src="../../../g4uimageprototype.png" onclick="window.location.href = '../../adminpage.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
       </div>


<div class="outputresults">



<?php
$SupplierID = $_GET['SupplierID'];

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

$sqlQuery = $pdo->prepare('SELECT * FROM supplier WHERE SupplierID = ?');
$sqlQuery->execute([$SupplierID]);

while($row = $sqlQuery->fetch())
{
?>



	
<br>
<form action="UpdateSupplier.php" method="POST" align="center">
<label for="SupplierID" style="width: 150px">Supplier ID: </label>
<input type="text" class="form-control" readonly="readonly" name="SupplierID" value="<?php echo $row['SupplierID'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="SupplierName" style="width: 150px">Supplier Name: </label>
<input type="text" class="form-control"  name="SupplierName" value="<?php echo $row['SupplierName'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="SupplierAddress" style="width: 150px">Supplier Address: </label>
<input type="text" class="form-control"  name="SupplierAddress" value="<?php echo $row['SupplierAddress'];?>" style="width: 300px; display: inline-block"><br><br>
	
<input type="submit" value="Update Supplier">
</form>

<?php 
}
?>

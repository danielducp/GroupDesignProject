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
        <img src="../../../g4uimageprototype.png" onclick="window.location.href = '../../adminpage.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
       </div>

<div class="outputresults">



<?php
$SuppliedProductsID = $_GET['SuppliedProductsID'];

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

$sqlQuery = $pdo->prepare('SELECT * FROM suppliedproducts WHERE SuppliedProductsID = ?');
$sqlQuery->execute([$SuppliedProductsID]);

while($row = $sqlQuery->fetch())
{
?>



	
<br><br>
<form action="UpdateSuppliedProducts.php" method="POST" align="center">
<label for="SuppliedProductID" style="width: 170px">Supplied Products ID: </label>
<input type="text" class="form-control" readonly="readonly" name="SuppliedProductsID" size="width:150px" value="<?php echo $row['SuppliedProductsID'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="SupplierID" style="width: 170px">Supplier ID: </label>
<input type="text" class="form-control"  name="SupplierID" value="<?php echo $row['SupplierID'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="SupplierName" style="width: 170px">Supplier Name: </label>
<input type="text" class="form-control"  name="SupplierName" value="<?php echo $row['SupplierName'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="DeliveryTime" style="width: 170px">Delivery Time: </label>
<input type="number" class="form-control"  name="DeliveryTime" value="<?php echo $row['DeliveryTime'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="ItemCost" style="width: 170px">Item Cost: </label>
<input type="text" class="form-control"  name="ItemCost" value="<?php echo $row['ItemCost'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="VATCost" style="width: 170px">VAT Cost: </label>
<input type="text" class="form-control"  name="VATCost" value="<?php echo $row['VATCost'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="TotalCost" style="width: 170px">Total Cost: </label>
<input type="text" class="form-control"  name="TotalCost" value="<?php echo $row['TotalCost'];?>" style="width: 300px; display: inline-block"><br><br>
<label for="ProductCode" style="width: 170px">Product Code: </label>
<input type="text" class="form-control"  name="ProductCode" value="<?php echo $row['ProductCode'];?>" style="width: 300px; display: inline-block"><br><br>

	<input type="submit" class="form-control" value="Update Supplied Product" style="width:200px">
</form>

<?php 
}
?>

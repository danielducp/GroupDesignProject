<!DOCTYPE html>
<html>
<head>
<title>G4UItems</title>
<link href="ItemsPage.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous">
</head>
<body style="background-color:#a6b2c1">

<div class="topnav" ALIGN="center">  
        <button  class="btn btn-warning">Back</button>
        <img src="g4uimageprototype.png" alt="G4ULogo"  width="12.5%"></img>
              
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div>

<br><br>    <br><br><br><br>

</div>




</body>
</html>

<?php
$ProductID = $_GET['ProductID'];

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

$sqlQuery = $pdo->prepare('SELECT * FROM product WHERE ProductID = ?');
$sqlQuery->execute([$ProductID]);

while($row = $sqlQuery->fetch())
{
?>



	

<form action="productUpdateRunUpdate.php" method="POST">


Product ID: <input type="text" class="form-control" name="ProductID" size="width:150px" value="<?php echo $row['ProductID'];?>">
	Product Code: <input type="text" class="form-control"  name="ProductCode" value="<?php echo $row['ProductCode'];?>">
	Product Name: <input type="text" class="form-control"  name="ProductName" value="<?php echo $row['ProductName'];?>"><br>
	Product Image: <input type="text" class="form-control" name="ProductImage" value="<?php echo $row['ProductImage'];?>">
	Quantity Per Pack: <input type="text" class="form-control" name="QuantityPerPack" value="<?php echo $row['QuantityPerPack'];?>">
	Category ID: <input type="text" class="form-control" name="CategoryID" value="<?php echo $row['CategoryID'];?>"><br>
	Current Stock Level: <input type="text" class="form-control" name="CurrentStockLevel" value="<?php echo $row['CurrentStockLevel'];?>">
	Low Stock Level: <input type="text" class="form-control" name="LowStockLevel" value="<?php echo $row['LowStockLevel'];?>">

	<input type="submit" value="Update Product">
</form>

<?php 
}
?>

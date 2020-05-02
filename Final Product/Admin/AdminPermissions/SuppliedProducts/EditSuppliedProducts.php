


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



	

<form action="UpdateSuppliedProducts.php" method="POST">
Supplied Products ID: <input type="text" class="form-control" readonly="readonly" name="SuppliedProductsID" size="width:150px" value="<?php echo $row['SuppliedProductsID'];?>">
Supplier ID: <input type="text" class="form-control"  name="SupplierID" value="<?php echo $row['SupplierID'];?>">
Supplier Name: <input type="text" class="form-control"  name="SupplierName" value="<?php echo $row['SupplierName'];?>">
Delivery Time: <input type="number" class="form-control"  name="DeliveryTime" value="<?php echo $row['DeliveryTime'];?>">
Item Cost: <input type="text" class="form-control"  name="ItemCost" value="<?php echo $row['ItemCost'];?>">
VAT Cost: <input type="text" class="form-control"  name="VATCost" value="<?php echo $row['VATCost'];?>">
Total Cost: <input type="text" class="form-control"  name="TotalCost" value="<?php echo $row['TotalCost'];?>">
Product Code: <input type="text" class="form-control"  name="ProductCode" value="<?php echo $row['ProductCode'];?>">

	<input type="submit" value="Update Supplied Product">
</form>

<?php 
}
?>

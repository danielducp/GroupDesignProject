


<div class="outputresults">



<?php
$ProductCode = $_GET['ProductCode'];

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

$sqlQuery = $pdo->prepare('SELECT * FROM product WHERE ProductCode = ?');
$sqlQuery->execute([$ProductCode]);

while($row = $sqlQuery->fetch())
{
?>



	

<form action="UpdateProduct.php" method="POST">
    Product Code: <input type="text" class="form-control" readonly="readonly" name="ProductCode" size="width:150px" value="<?php echo $row['ProductCode'];?>">
	Product Name: <input type="text" class="form-control"  name="ProductName" value="<?php echo $row['ProductName'];?>">
	Product Image: <input type="text" class="form-control"  name="ProductImage" value="<?php echo $row['ProductImage'];?>"><br>
	Quantity Per Pack: <input type="text" class="form-control" name="QuantityPerPack" value="<?php echo $row['QuantityPerPack'];?>">
	Category ID: <input type="text" class="form-control" name="CategoryID" value="<?php echo $row['CategoryID'];?>">
	Current Stock Level: <input type="text" class="form-control" name="CurrentStockLevel" value="<?php echo $row['CurrentStockLevel'];?>"><br>

    Low Stock Level: <input type="text" class="form-control" name="LowStockLevel" value="<?php echo $row['LowStockLevel'];?>"><br>
	<input type="submit" value="Update Product">
</form>

<?php 
}
?>

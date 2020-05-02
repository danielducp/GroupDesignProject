


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



	

<form action="UpdateCategory.php" method="POST">
Category ID: <input type="text" class="form-control" readonly="readonly" name="CategoryID" size="width:150px" value="<?php echo $row['CategoryID'];?>">
Category Name: <input type="text" class="form-control"  name="CategoryName" value="<?php echo $row['CategoryName'];?>">
	
	<input type="submit" value="Update Category">
</form>

<?php 
}
?>

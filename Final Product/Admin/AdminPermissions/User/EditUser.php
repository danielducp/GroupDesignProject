


<div class="outputresults">



<?php
$StaffID = $_GET['StaffID'];

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

$sqlQuery = $pdo->prepare('SELECT * FROM staff WHERE StaffID = ?');
$sqlQuery->execute([$StaffID]);

while($row = $sqlQuery->fetch())
{
?>



	

<form action="UpdateUser.php" method="POST">
	Staff ID: <input type="text" class="form-control" readonly="readonly" name="StaffID" size="width:150px" value="<?php echo $row['StaffID'];?>">
	Staff Title: <input type="text" class="form-control"  name="StaffTitle" value="<?php echo $row['StaffTitle'];?>">
	Staff Name: <input type="text" class="form-control"  name="StaffName" value="<?php echo $row['StaffName'];?>"><br>
	Staff Role: <input type="text" class="form-control" name="StaffRole" value="<?php echo $row['StaffRole'];?>">
	Store ID: <input type="text" class="form-control" name="StoreID" value="<?php echo $row['StoreID'];?>">
	Department ID: <input type="text" class="form-control" name="DepartmentID" value="<?php echo $row['DepartmentID'];?>"><br>
	Password: <input type="text" class="form-control" name="Password" value="<?php echo $row['Password'];?>">

	<input type="submit" value="Update User">
</form>

<?php 
}
?>

<?php
$host = 'localhost';
$db   = 'g4udatabase';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$SupplierID = $_GET['SupplierID'];

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


$sqlQuery = $pdo->prepare("DELETE FROM supplier  WHERE SupplierID =  :SupplierID");
$sqlQuery->execute(['SupplierID' => $SupplierID]);

echo"Supplier, ".$SupplierID." has been deleted";
header('Refresh: 5; URL=../../adminpage.php');














?>
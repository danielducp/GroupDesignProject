<?php


  require 'config.php';



$sqlQuery = $pdo->prepare('UPDATE product  SET `CurrentStockLevel` =  `CurrentStockLevel`  - 1');
$sqlQuery->execute([]);

echo 'All Stock has been decreased by 1';
header('Refresh: 5; URL=adminpage.php');
?>
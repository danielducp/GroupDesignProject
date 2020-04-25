<?php
 require 'config.php'; 
$sqlQuery = $pdo->prepare("INSERT INTO `order` (
`DeliveryDate`,
`TransactionID`,
`StaffID`,
`DeliveryStatus`) VALUES (NULL, 0, 0, NULL) WHERE `product`.CurrentStockLevel < `product`.LowStockLevel");
$sqlQuery->execute();
echo "Order has been"
?>
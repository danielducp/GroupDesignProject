
 
 <?php
require ("config.php");



$OrderID=$_GET['OrderID'];
$ProductCode=$_GET['ProductCode'];


$sqlQuery = $pdo->prepare('UPDATE `order` INNER JOIN orderedproducts ON `order`.OrderID = orderedproducts.OrderID INNER JOIN product ON orderedproducts.ProductCode = product.ProductCode   SET DeliveryStatus = 1 WHERE `order`.OrderID = :OrderID AND product.ProductCode =  :ProductCode');

$sqlQuery-> bindParam(':OrderID', $OrderID);

$sqlQuery-> bindParam(':ProductCode', $ProductCode);
$sqlQuery->execute();


$sqlQuery2 = $pdo->prepare('UPDATE `suppliedorder` INNER JOIN `order` ON suppliedorder.OrderID = `order`.OrderID 
 INNER JOIN supplier ON suppliedorder.SupplierID = supplier.SupplierID 
INNER JOIN suppliedproducts ON suppliedorder.ProductCode = suppliedproducts.ProductCode SET Delivered = 1 WHERE `order`.OrderID = :OrderID AND suppliedorder.ProductCode =  :ProductCode');

$sqlQuery2-> bindParam(':OrderID', $OrderID);
$sqlQuery2-> bindParam(':ProductCode', $ProductCode);
$sqlQuery2->execute();


echo "Order Confirmed!";

?>


<br>

</div>


</body>
</html>

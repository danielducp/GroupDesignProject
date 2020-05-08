
 
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];

$sqlQuery = $pdo->prepare('UPDATE `order` SET OrderConfirmed = 1 WHERE OrderID = :OrderID');
$sqlQuery2 = $pdo->prepare('UPDATE `orderedproducts` SET Authorised = 1 WHERE OrderID = :OrderID');

$sqlQuery->execute(['OrderID' => $OrderID]);
$sqlQuery2->execute(['OrderID' => $OrderID]);



echo "Order Confirmed!"

?>


<br>

</div>


</body>
</html> 

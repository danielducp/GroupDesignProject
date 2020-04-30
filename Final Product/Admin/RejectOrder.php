
 
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];

$sqlQuery = $pdo->prepare('DELETE `orderedproducts`,  `suppliedorder`, `order`
FROM `order` INNER JOIN `orderedproducts` ON `order`.OrderID = `orderedproducts`.OrderID
INNER JOIN `suppliedorder` ON `order`.OrderID = `suppliedorder`.OrderID
WHERE `orderedproducts`.OrderID = :OrderID;');


$sqlQuery->execute(['OrderID' => $OrderID]);


echo "Order Deleted!"

?>


<br>

</div>


</body>
</html>

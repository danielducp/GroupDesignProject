
 
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];

$sqlQuery = $pdo->prepare('DELETE `orderedproducts`,  `suppliedorder`
FROM `orderedproducts` INNER JOIN `order` ON `orderedproducts`.OrderID = `order`.OrderID
INNER JOIN `suppliedorder` ON `order`.OrderID = `suppliedorder`.OrderID
WHERE `orderedproducts`.OrderID = :OrderID;');


$sqlQuery->execute(['OrderID' => $OrderID]);


//echo "Order Deleted!"

?>


 
<?php
require ("config.php");

$OrderID=$_GET['OrderID'];

$sqlQuery = $pdo->prepare('DELETE `order` FROM  `order` WHERE `order`.OrderID = :OrderID;');


$sqlQuery->execute(['OrderID' => $OrderID]);


echo "Order Deleted! You will now be redirected!";
header("refresh:5;url=SystemReport.php");
?>


<br>

</div>


</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>

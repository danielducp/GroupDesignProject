<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../Login/Homepage.php") ;
    }
    ?>
 
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];
$sqlQuery = $pdo->prepare('SELECT * FROM `order`
INNER JOIN `suppliedorder` ON `order`.OrderID =  suppliedorder.OrderID
INNER JOIN `supplier` ON `suppliedorder`.SupplierID =  `supplier`.SupplierID 
 INNER JOIN `product` ON `suppliedorder`.ProductCode =  `product`.ProductCode 
 INNER JOIN `orderedproducts` ON `product`.ProductCode =  `orderedproducts`.ProductCode 
 WHERE    `orderedproducts`.OrderID = :OrderID AND  `order`.OrderID = :OrderID2  ');
 $sqlQuery-> bindParam(':OrderID', $OrderID);
 $sqlQuery-> bindParam(':OrderID2', $OrderID);

$sqlQuery->execute();

echo "<TABLE BORDER=1 width=600>";
while($row = $sqlQuery->fetch())

{
 



    ?>
      <?php
echo "<TD align=center>Order ID: ".$row['OrderID']."<br>";

echo "<align=center>Product Code: ".$row['ProductCode']."<br>";



	echo "<align = center>Quantity Ordered:  ".$row['QuantityOrdered']."<br>";


	echo"";


echo "<TR>";
  }

?>


<br>

</div>


</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>

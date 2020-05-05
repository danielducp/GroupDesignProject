<body style="background-color:#a6b2c1">

 
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];
$sqlQuery = $pdo->prepare('SELECT * FROM `order`
INNER JOIN `suppliedorder` ON `order`.OrderID =  suppliedorder.OrderID
INNER JOIN `supplier` ON `suppliedorder`.SupplierID =  `supplier`.SupplierID 
 INNER JOIN `product` ON `suppliedorder`.ProductCode =  `product`.ProductCode 
 INNER JOIN `orderedproducts` ON `product`.ProductCode =  `orderedproducts`.ProductCode 
 WHERE    `orderedproducts`.OrderID = :OrderID AND  `order`.OrderID = :OrderID2  AND suppliedorder.Delivered = 0 ');
 $sqlQuery-> bindParam(':OrderID', $OrderID);
 $sqlQuery-> bindParam(':OrderID2', $OrderID);

$sqlQuery->execute();

echo "<TABLE BORDER=1 width=600>";
while($row = $sqlQuery->fetch())

{
 



    ?>
      <?php
echo "<TD align=center>Product Code: ".$row['ProductCode']."<br>";


	echo "<align = center>Estimated Delivery Date:  ".$row['DeliveryDate']."<br>";

	echo "<align = center>Quantity Ordered:  ".$row['QuantityOrdered']."<br>";

  echo " <div class=button onclick=location.href='ConfirmDelivery.php?OrderID=".$row['OrderID']."?&&ProductCode=".$row['ProductCode']."'>Confirm Delivery</div>";



	echo"";


echo "<TR>";
  }

?>


<br>

</div>


</body>
</html>

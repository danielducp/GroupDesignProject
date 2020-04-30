
 
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];
$sqlQuery = $pdo->prepare('SELECT * FROM `order` INNER JOIN `orderedproducts` ON `order`.OrderID =  `orderedproducts`.OrderID WHERE `order`.OrderID = :OrderID');
$sqlQuery->execute(['OrderID' => $OrderID]);


echo "<TABLE BORDER=1 width=600>";
while($row = $sqlQuery->fetch())

{
 



    ?>
      <?php

echo "<TD align=center>Product Code: ".$row['ProductCode']."<br>";

echo "<align = center>Staff ID: ".$row['StaffID']."<br>";

	echo "<align = center>QuantityOrdered: ".$row['QuantityOrdered']."<br>";

  echo " <div class=button onclick=location.href='ConfirmOrder.php?OrderID=".$row['OrderID']."'>Confirm Order</div>";

  echo " <div class=button onclick=location.href='RejectOrder.php?OrderID=".$row['OrderID']."'>Reject Order</div></td>";

 

	echo"";


echo "<TR>";
  }

?>


<br>

</div>


</body>
</html>

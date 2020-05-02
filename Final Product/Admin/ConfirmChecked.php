
 
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
INNER JOIN suppliedproducts ON suppliedorder.ProductCode = suppliedproducts.ProductCode SET Checked = 1 WHERE `order`.OrderID = :OrderID AND suppliedorder.ProductCode =  :ProductCode');

$sqlQuery2-> bindParam(':OrderID', $OrderID);
$sqlQuery2-> bindParam(':ProductCode', $ProductCode);
$sqlQuery2->execute();


echo "Order Checked!";

?>
<?php
require ("config.php");
$OrderID=$_GET['OrderID'];
$ProductCode=$_GET['ProductCode'];
$sqlQuery = $pdo->prepare('SELECT * FROM `product` INNER JOIN
`orderedproducts` ON  `product`.ProductCode =  `orderedproducts`.ProductCode  WHERE `orderedproducts`.OrderID = :OrderID AND product.ProductCode =  :ProductCode');
$sqlQuery-> bindParam(':OrderID', $OrderID);
$sqlQuery-> bindParam(':ProductCode', $ProductCode);

$sqlQuery->execute();
while($row = $sqlQuery->fetch())

{
 

    echo "<br>"."csl ". $row['CurrentStockLevel'];

echo "<br>"."qo ". $row['QuantityOrdered'];

echo "<br>"."qo ". $row['QuantityPerPack'];

$sqlQuery2 = $pdo->prepare('UPDATE product
INNER JOIN orderedproducts ON product.ProductCode = orderedproducts.ProductCode
SET product.CurrentStockLevel = :CurrentStockLevel
WHERE  orderedproducts.OrderID =  :OrderID AND product.ProductCode =  :ProductCode');

  

$sqlQuery2-> bindParam(':CurrentStockLevel', $CurrentStockLevel);
$CurrentStockLevel = (($row['QuantityOrdered']*$row['QuantityPerPack'])+$row['CurrentStockLevel']);
$sqlQuery2-> bindParam(':OrderID', $OrderID);
$sqlQuery2-> bindParam(':ProductCode', $ProductCode);

  $sqlQuery2->execute();
}
?>



<?php

$OrderID=$_GET['OrderID'];

$sqlQuery = $pdo->prepare('SELECT * from department
INNER JOIN staff on department.DepartmentID = staff.DepartmentID
INNER JOIN `order` ON staff.StaffID = `order`.StaffID
INNER JOIN orderedproducts ON `order`.OrderID = orderedproducts.OrderID
INNER JOIN product ON `orderedproducts`.ProductCode = product.ProductCode WHERE `orderedproducts`.OrderID = :OrderID AND product.ProductCode =  :ProductCode');
$sqlQuery-> bindParam(':OrderID', $OrderID);
$sqlQuery-> bindParam(':ProductCode', $ProductCode);

$sqlQuery->execute();
while($row = $sqlQuery->fetch())

{
  echo "<br>"."TE ". $row['OrderTotal'];

  echo "<br>"."TE ". $row['TotalExpenditure'];


  $sqlQuery2 = $pdo->prepare('UPDATE department
  INNER JOIN staff on department.DepartmentID = staff.DepartmentID
  INNER JOIN `order` ON staff.StaffID = `order`.StaffID
  INNER JOIN orderedproducts ON `order`.OrderID = orderedproducts.OrderID
  INNER JOIN product ON `orderedproducts`.ProductCode = product.ProductCode

  SET department.TotalExpenditure = :OrderTotal
  WHERE  orderedproducts.OrderID =  :OrderID ');
  
   
  $sqlQuery2-> bindParam(':OrderID', $OrderID);
  $sqlQuery2-> bindParam(':OrderTotal', $OrderTotal);
$OrderTotal=  ($row['TotalExpenditure'] + $row['OrderTotal']);

    $sqlQuery2->execute();


echo "Order Checked!";




  }

  ?>

<br>

</div>


</body>
</html>

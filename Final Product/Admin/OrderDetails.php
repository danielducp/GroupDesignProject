<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../Login/Homepage.php") ;
    }
    ?>
 <body style="background-color:#a6b2c1">
 <?php
require ("config.php");

$OrderID=$_GET['OrderID'];
$sqlQuery = $pdo->prepare('SELECT * FROM `order` INNER JOIN `orderedproducts` ON `order`.OrderID =  `orderedproducts`.OrderID WHERE `order`.OrderID = :OrderID');
$sqlQuery->execute(['OrderID' => $OrderID]);


echo "<TABLE BORDER=1  align=center width=600>";
while($row = $sqlQuery->fetch())

{
 



    ?>
      <?php

echo "<TD align=center>Product Code: ".$row['ProductCode']."<br>";


	echo "<align = center>QuantityOrdered: ".$row['QuantityOrdered']."<br>";



 

	echo"";


echo "<TR>";

  }
  echo "</table>";
?>

<?php
require ("config.php");

$OrderID=$_GET['OrderID'];
$sqlQuery = $pdo->prepare('SELECT DISTINCT * FROM `order`  WHERE `order`.OrderID = :OrderID');
$sqlQuery->execute(['OrderID' => $OrderID]);


echo "";
while($row = $sqlQuery->fetch())

{
 



    ?>
      <?php


echo "<div class <TD align=center>Staff ID: ".$row['StaffID']."<br>";

echo " <div class=button onclick=location.href='ConfirmOrder.php?OrderID=".$row['OrderID']."' <TD align=center>Confirm Order</div>";

echo " <div class=button onclick=location.href='RejectOrder.php?OrderID=".$row['OrderID']."' <TD align=center>Reject Order</div>";

 

	echo"";


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

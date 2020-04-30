<?php 
       require ("config.php");
      
    $sql = "SELECT distinct orderedproducts.OrderID  FROM `order` 
    inner join orderedproducts ON `order`.OrderID = orderedproducts.OrderID  WHERE OrderConfirmed = '1' AND  DeliveryStatus = '0' ;
    ";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
   
    echo "<TABLE BORDER=1 width=600>";
while($row = $stmt->fetch())
{
    echo "<TD align=center>".$row['OrderID']."";




    echo "<div class=resultbutton onclick=location.href='OrderDeliveryInformation.php?OrderID=".$row['OrderID']."'>More Information</div></td>";

  }
  
?>
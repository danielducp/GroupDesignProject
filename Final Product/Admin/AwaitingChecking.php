<?php 
       require ("config.php");
      
    $sql = "SELECT distinct orderedproducts.OrderID  FROM `order` 
    inner join orderedproducts ON `order`.OrderID = orderedproducts.OrderID
    INNER JOIN `suppliedorder` ON `order`.OrderID = `suppliedorder`.OrderID
    
      WHERE OrderConfirmed = '1' AND  DeliveryStatus = '1'  AND  Checked = '0' ;
    ";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
   
    echo "<TABLE BORDER=1 width=600>";
while($row = $stmt->fetch())
{
    echo "<TD align=center>".$row['OrderID']."";




    echo "<div class=resultbutton onclick=location.href='OrderCheckedInformation.php?OrderID=".$row['OrderID']."'>More Information</div></td>";

  }
  
?>
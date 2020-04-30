<?php 
       require ("config.php");
      
    $sql = "SELECT * FROM `order`  WHERE `order`.OrderConfirmed = '0';
    ";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
   
    echo "<TABLE BORDER=1 width=600>";
while($row = $stmt->fetch())
{
    echo "<TD align=center>".$row['OrderID']."";



    echo "<div class=resultbutton onclick=location.href='OrderDetails.php?OrderID=".$row['OrderID']."'>More Information</div></td>";

  }
?>
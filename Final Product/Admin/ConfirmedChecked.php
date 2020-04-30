
 
 <?php
require ("config.php");

$sqlQuery = $pdo->prepare('SELECT * FROM `suppliedorder`
 WHERE suppliedorder.Checked = 1 ');
 $sqlQuery-> bindParam(':OrderID', $OrderID);
 $sqlQuery-> bindParam(':OrderID2', $OrderID);
$sqlQuery->execute();

echo "<TABLE BORDER=1 width=600>";
while($row = $sqlQuery->fetch())

{
 



    ?>
      <?php

echo "<TD align=center>Product Code: ".$row['ProductCode']."<br>";




  echo " <div class=button onclick=location.href='ViewCheckedInformation.php?OrderID=".$row['OrderID']."?&&ProductCode=".$row['ProductCode']."'>Check Confirm Ordered Product</div>";



	echo"";


echo "<TR>";
  }

?>


<br>

</div>


</body>
</html>

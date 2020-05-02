
    <?php
  
  require 'config.php';
  session_start(); // should be at the top of your php

  if (isset($_POST['SuppliedProductsID'])) {
     $_SESSION['SuppliedProductsID'] = $_POST['SuppliedProductsID'];
  }
   $SuppliedProductsID = isset($_SESSION['SuppliedProductsID']) ? $_SESSION['SuppliedProductsID'] : "";




  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }
  $numberofrecords = 4;
  $offset = ($pageno-1) * $numberofrecords;
  if($SuppliedProductsID!=""){
  $stmt = $pdo->prepare("SELECT * FROM suppliedproducts WHERE SuppliedProductsID =?"); 
  $stmt->execute([$SuppliedProductsID]);
  $totalnumberofrows = $stmt ->rowCount();
  $total_pages = ceil($totalnumberofrows / $numberofrecords);
  $stmt = $pdo->prepare("SELECT * FROM suppliedproducts WHERE SuppliedProductsID ='".$SuppliedProductsID."'LIMIT $offset, $numberofrecords "); 
$stmt->execute();}
?>


<div class="container">

<div class="outputresults">

<br>


<?php


echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

      echo "<TD align=center>".$row['SuppliedProductsID']."</TD>";
      echo "<TD align=center><a href='EditSuppliedProduct.php?SuppliedProductsID=".$row['SuppliedProductsID']."'>Edit</a>";
      echo "<TD align=center><a href='DeleteSuppliedProduct.php?SuppliedProductsID=".$row['SuppliedProductsID']."'>Delete Category</a>";

}
echo "</TABLE>";

?>


<br>

  
  </div>
  </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
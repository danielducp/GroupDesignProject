<head>
<title>G4U</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="Admin.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color:#a6b2c1">
  <div class="topnav" ALIGN="center">
    <img src="g4uimageprototype.png" alt="G4ULogo" width="12.5%"></img>
    <input type="text" placeholder="Search.." style="margin-top: 100px;">
    <button id="search-button" class="btn btn-success">Search!</button>
    <button id="basket-button" class="btn btn-warning">Basket</button>
    <button id="logout-button" class="btn btn-danger">Log Out!</button>
  </div>
    <?php
  
  require 'config.php';
  session_start(); // should be at the top of your php

  if (isset($_POST['SupplierID'])) {
     $_SESSION['SupplierID'] = $_POST['SupplierID'];
  }
   $SupplierID = isset($_SESSION['SupplierID']) ? $_SESSION['SupplierID'] : "";




  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }
  $numberofrecords = 4;
  $offset = ($pageno-1) * $numberofrecords;
  if($SupplierID!=""){
  $stmt = $pdo->prepare("SELECT * FROM supplier WHERE SupplierID =?"); 
  $stmt->execute([$SupplierID]);
  $totalnumberofrows = $stmt ->rowCount();
  $total_pages = ceil($totalnumberofrows / $numberofrecords);
  $stmt = $pdo->prepare("SELECT * FROM supplier WHERE SupplierID ='".$SupplierID."'LIMIT $offset, $numberofrecords "); 
$stmt->execute();}
?>


<div class="container">

<div class="outputresults">

<br>


<?php


echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

      echo "<TD align=center>".$row['SupplierID']."</TD>";
      echo "<TD align=center><a href='EditSupplier.php?SupplierID=".$row['SupplierID']."'>Edit</a>";
      echo "<TD align=center><a href='DeleteSupplier.php?SupplierID=".$row['SupplierID']."'>Delete Supplier</a>";

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
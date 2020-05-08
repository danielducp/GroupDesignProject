<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../../../Login/Homepage.php") ;
    }
    ?><head>
  <title>G4U</title>
  <link rel="stylesheet" href="../../../style.css" type="text/css">
  <link rel="stylesheet" href="../../../website.css" type="text/css">
  <link rel="stylesheet" href="Admin.css"  type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../../../Back.png" onclick="goBack()" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../../../g4uimageprototype.png" onclick="window.location.href = '../../adminpage.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
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
</html> <script>
function goBack() {
  window.history.back();
}
</script>
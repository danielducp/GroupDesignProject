
<head>
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



<div class="outputresults" align="center">


 <div class="col-sm-3">
        <form action="SuppliedProductsLocked.php" method="POST">
            Please enter preferred SuppliedProductsID:
            <br>
            <input type="text" class="form-control" name="SuppliedProductsID" style="width: 300px; display: inline-block;">
 
	
            <input type="submit" name="submit" class="btn btn-primary" value="Search">
        </form>


<form action="SuppliedProductsLocked.php" method="post">
 <select name="SuppliedProductsID" id="SuppliedProductsID" searchable="Search here">
            <option value="" selected="true" disabled="disabled">Select Supplied Product ID </option>
            <?php
            $data=load_SuppliedProductsID();
            foreach ($data as $row): 
            echo '<option value="'.$row["SuppliedProductsID"].'">'.$row["SuppliedProductsID"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
			
			  </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" style="display:inline" class="btn btn-primary" value="Search">


          </tr>
        <tr>

    </div>

  </div>
</div>


<?php function load_SuppliedProductsID()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT SuppliedProductsID FROM suppliedproducts ORDER BY SuppliedProductsID ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}


?>


<?php
require ("config.php");



    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } else {
      $pageno = 1;
    }
    $numberofrecords = 4;
    $offset = ($pageno-1) * $numberofrecords;

    $stmt = $pdo->prepare("SELECT * FROM suppliedproducts ORDER BY SuppliedProductsID "); 
    $stmt->execute([]);
    $totalnumberofrows = $stmt ->rowCount();
    $total_pages = ceil($totalnumberofrows / $numberofrecords);
    $stmt = $pdo->prepare("SELECT * FROM suppliedproducts ORDER BY SuppliedProductsID LIMIT $offset, $numberofrecords "); 
$stmt->execute();

?>
<br>

<div class="container" align="center">

 <div class="outputresults">

		          <input type="button" style="display:inline" onclick=window.location.href="addasuppliedproduct.php" class="btn btn-primary" value="Add a Supplied Product"> </td>
              <br>


<?php

echo"<br>";
echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

		echo "<TR>";
	
		echo "<TD align=center>".$row['SuppliedProductsID']."</TD>";
		echo "<TD align=center><a href='EditSuppliedProducts.php?SuppliedProductsID=".$row['SuppliedProductsID']."'>Edit</a>";
		echo "<TD align=center><a href='DeleteSuppliedProducts.php?SuppliedProductsID=".$row['SuppliedProductsID']."'>Delete Supplied Product ID</a>";
	echo "</TR>";
  }
echo "</TABLE>";

?>
<br>
      <ul class="pagination">
          <li ><a class="page-link" href="?pageno=1">First Page</a></li>
          <li <?php if($pageno <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous Page</a>
          </li>
          <li  <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next Page</a>
          </li>
          <li><a class="page-link"  href="?pageno=<?php echo $total_pages; ?>">Last Page</a></li>
      </ul>
</div>
</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>

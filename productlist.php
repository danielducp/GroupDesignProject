



<div class="outputresults">


 <div class="col-sm-3">
        <form action="adminlocked2.php" method="POST">
            Please enter preferred Product ID:
            <br>
            <input type="text" class="form-control" name="ProductID">
 
	
            <input type="submit" name="submit" class="btn btn-danger" value="Search">
        </form>


<form action="adminlocked2.php" method="post">
 <select name="ProductID" id="ProductID" searchable="Search here">
            <option value="" selected="true" disabled="disabled">Select Car </option>
            <?php
            $data=load_ProductID();
            foreach ($data as $row): 
            echo '<option value="'.$row["ProductID"].'">'.$row["ProductID"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
			
			  </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" style="display:inline" class="btn btn-danger" value="Search">


          </tr>
        <tr>

    </div>

  </div>
</div>


<?php function load_ProductID()
{
  $data='';
  require 'config.php';
  $sqlProductID=$pdo->prepare('SELECT DISTINCT ProductID FROM product ORDER BY ProductID ASC');
  $sqlProductID ->execute();
  $data=$sqlProductID-> fetchAll();
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

    $stmt = $pdo->prepare("SELECT * FROM product ORDER BY ProductID "); 
    $stmt->execute([]);
    $totalnumberofrows = $stmt ->rowCount();
    $total_pages = ceil($totalnumberofrows / $numberofrecords);
    $stmt = $pdo->prepare("SELECT * FROM product ORDER BY ProductID LIMIT $offset, $numberofrecords "); 
$stmt->execute();

?>
<br>

<div class="container">

 <div class="outputresults">

		          <input type="button" style="display:inline" onclick=window.location.href="carinsert.php" class="btn btn-danger" value="Add a car"> </td>


<?php

echo"<br>";
echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

		echo "<TR>";

		echo "<TD align=center>".$row['ProductID']."</TD>";
		echo "<TD align=center><a href='updateProduct.php?ProductID=".$row['ProductID']."'>Edit</a>";
		echo "<TD align=center><a href='deleteCar.php?ProductID=".$row['ProductID']."'>Delete Car</a>";
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
</html>

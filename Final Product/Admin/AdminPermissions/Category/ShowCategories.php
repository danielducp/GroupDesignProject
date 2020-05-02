<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:adminlogin.php") ;
    }
    ?>
<head>




<div class="outputresults">


 <div class="col-sm-3">
        <form action="CategoriesLocked.php" method="POST">
            Please enter preferred CategoryID:
            <br>
            <input type="text" class="form-control" name="CategoryID">
 
	
            <input type="submit" name="submit" class="btn btn-primary" value="Search">
        </form>


<form action="CategoriesLocked.php" method="post">
 <select name="CategoryID" id="CategoryID" searchable="Search here">
            <option value="" selected="true" disabled="disabled">Select Category </option>
            <?php
            $data=load_CategoryID();
            foreach ($data as $row): 
            echo '<option value="'.$row["CategoryID"].'">'.$row["CategoryID"].'</option>';
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


<?php function load_CategoryID()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT CategoryID FROM category ORDER BY CategoryID ASC');
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

    $stmt = $pdo->prepare("SELECT * FROM category ORDER BY CategoryID "); 
    $stmt->execute([]);
    $totalnumberofrows = $stmt ->rowCount();
    $total_pages = ceil($totalnumberofrows / $numberofrecords);
    $stmt = $pdo->prepare("SELECT * FROM category ORDER BY CategoryID LIMIT $offset, $numberofrecords "); 
$stmt->execute();

?>
<br>

<div class="container">

 <div class="outputresults">

		          <input type="button" style="display:inline" onclick=window.location.href="addaCategory.php" class="btn btn-primary" value="Add a user"> </td>


<?php

echo"<br>";
echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

		echo "<TR>";
	
		echo "<TD align=center>".$row['CategoryID']."</TD>";
		echo "<TD align=center><a href='EditCategory.php?CategoryID=".$row['CategoryID']."'>Edit</a>";
		echo "<TD align=center><a href='DeleteCategory.php?CategoryID=".$row['CategoryID']."'>Delete Supplier</a>";
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

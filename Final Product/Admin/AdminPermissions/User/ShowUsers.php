



<div class="outputresults">


 <div class="col-sm-3">
        <form action="UsersLocked.php" method="POST">
            Please enter preferred StaffID:
            <br>
            <input type="text" class="form-control" name="StaffID">
 
	
            <input type="submit" name="submit" class="btn btn-primary" value="Search">
        </form>


<form action="UsersLocked.php" method="post">
 <select name="StaffID" id="StaffID" searchable="Search here">
            <option value="" selected="true" disabled="disabled">Select User </option>
            <?php
            $data=load_StaffID();
            foreach ($data as $row): 
            echo '<option value="'.$row["staffid"].'">'.$row["staffid"].'</option>';
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


<?php function load_StaffID()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT staffid FROM newstaff ORDER BY staffid ASC');
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

    $stmt = $pdo->prepare("SELECT * FROM newstaff ORDER BY staffid "); 
    $stmt->execute([]);
    $totalnumberofrows = $stmt ->rowCount();
    $total_pages = ceil($totalnumberofrows / $numberofrecords);
    $stmt = $pdo->prepare("SELECT * FROM newstaff ORDER BY staffid LIMIT $offset, $numberofrecords "); 
$stmt->execute();

?>
<br>

<div class="container">

 <div class="outputresults">

		          <input type="button" style="display:inline" onclick=window.location.href="addauser.php" class="btn btn-primary" value="Add a user"> </td>


<?php

echo"<br>";
echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

		echo "<TR>";
	
		echo "<TD align=center>".$row['staffid']."</TD>";
		echo "<TD align=center><a href='EditUser.php?staffid=".$row['staffid']."'>Edit</a>";
		echo "<TD align=center><a href='DeleteUser.php?staffid=".$row['staffid']."'>Delete User</a>";
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

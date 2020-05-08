<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../../../Login/Homepage.php") ;
    }
    ?>

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



<div class="outputresults">


 

<?php
require ("config.php");



    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } else {
      $pageno = 1;
    }
    $numberofrecords = 4;
    $offset = ($pageno-1) * $numberofrecords;

    $stmt = $pdo->prepare("SELECT * FROM newstaff WHERE PasswordNeedsResetting = 1 ORDER BY staffid "); 
    $stmt->execute([]);
    $totalnumberofrows = $stmt ->rowCount();
    $total_pages = ceil($totalnumberofrows / $numberofrecords);
    $stmt = $pdo->prepare("SELECT * FROM newstaff WHERE PasswordNeedsResetting = 1 ORDER BY staffid LIMIT $offset, $numberofrecords "); 
$stmt->execute();

?>
<br>

<div class="container">

 
<?php

echo"<br>";
echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

		echo "<TR>";
	
		echo "<TD align=center>".$row['staffid']."</TD>";
		echo "<TD align=center><a href='ChangePasswordPage.php?staffid=".$row['staffid']."'>Edit</a>";
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

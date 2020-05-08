<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../Login/Homepage.php") ;
    }
    ?><head>
  <title>G4U</title>
  <link rel="stylesheet" href="../style.css" type="text/css">
  <link rel="stylesheet" href="../website.css" type="text/css">
  <link rel="stylesheet" href="Admin.css"  type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../Back.png" onclick="goBack()" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../g4uimageprototype.png" onclick="window.location.href = 'adminpage.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
       <img src="../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../logout.php'" ></img>
       </div>
  <h1 style="padding-left:20px">Awaiting Checking</h1>
<?php 
       require ("config.php");
      
    $sql = "SELECT distinct orderedproducts.OrderID  FROM `order` 
    inner join orderedproducts ON `order`.OrderID = orderedproducts.OrderID
    INNER JOIN `suppliedorder` ON `order`.OrderID = `suppliedorder`.OrderID
    
      WHERE OrderConfirmed = '1' AND   Delivered = '1' AND  Checked = '0' ;
    ";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
   
    echo "<TABLE BORDER=1 width=600>";
while($row = $stmt->fetch())
{
    echo "<TD align=center>".$row['OrderID']."";




    echo "<div class=resultbutton onclick=location.href='OrderCheckedInformation.php?OrderID=".$row['OrderID']."'>More Information</div></td>";

  }
  
?>
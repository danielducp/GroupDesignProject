<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../Login/Homepage.php") ;
    }
    ?><!DOCTYPE html>
<html>
<head>
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

    <div class="container" ALIGN="center">
      
        <div class="row" style="padding-top:35px;">
          
            <div class="col" ALIGN="center">
              <button  class="btn btn-success"  onclick="window.location.href = 'PendingOrders.php';">Pending Orders</button>
            </div>
          
         
          </div>
          <div class="row" style="padding-top:35px;">
            <div class="col" ALIGN="center">
              <button  class="btn btn-success" onclick="window.location.href = 'closetolowstock.php';">Close to Low Stock</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success" onclick="window.location.href = 'departmentexpenditure.php';">Department Expenditure</button>
            </div>
         
            
            </div>
            <div class="row" style="padding-top:35px;">
            <div class="col" ALIGN="center">
              <button  class="btn btn-success" onclick="window.location.href = 'AwaitingDelivery.php';">Awaiting Delivery</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success" onclick="window.location.href = 'AwaitingChecking.php';">Awaiting Checking</button>
            </div>

            <div class="col" ALIGN="center">
              <button  class="btn btn-success" onclick="window.location.href = 'ConfirmedChecked.php';">View Checked Ordered Products</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success" onclick="window.location.href = 'CheckReturns.php';">View Returned Ordered Products</button>
            </div>
   
            
          </div>
    </div>

    
</body>


</html> <script>
function goBack() {
  window.history.back();
}
</script>
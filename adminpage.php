
<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
      echo"You need to login";
    header("Location:homepage.php") ;
    }
    if($_SESSION["role"]==3){
        header('adminpage.php');
        echo "Welcome";
        echo $_SESSION['StaffID']; 
      } else {
        session_destroy();

        header("Location:homepage.php") ;
    }
    ?>

<head>

  <!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="website.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <body style="background-color:#a6b2c1">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg">
<img src="g4uimageprototype.png" alt="G4ULogo"  id="g4ulogo"></img>
</div>

<div class="col-lg">
    
    <div class="topnav" >  
    <div class="search-box" style="align:left; width:200px ">
        <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
</div>


       
     
           
        </div>
</div>
        <div class ="col-lg">
            <button id="basket-button" class="btn btn-warning">Basket</button>	
            <button id="logout-button"    class="btn btn-danger"><a href="logout.php" style="color:white; height:150px;">Log Out!</a></button>	
      
        </div>
    </div>
  </div>



<body style="background-color:#a6b2c1">

<img width="12.5%"src="g4uimageprototype.png" ALIGN="left" alt="G4ULogo"></img>

<br><br>  <br>  <br><br><br><br>

<button style="background-color: red" onclick="window.location.href = 'addauser.php';"> Add a user </button>

<button style="background-color: orange" onclick="window.location.href = 'addauser.php';"> Edit a user </button>

<button style="background-color: red" onclick="window.location.href = 'addaproduct.php';"> Add a product </button>

<button style="background-color: orange" onclick="window.location.href = 'addauser.php';"> Edit a product </button>


<button style="background-color: red" onclick="window.location.href = 'addacategory.php';"> Add a category </button>

<button style="background-color: orange" onclick="window.location.href = 'addauser.php';"> Edit a category </button>

<button style="background-color: red" onclick="window.location.href = 'addasupplier.php';"> Add a supplier </button>

<button style="background-color: orange" onclick="window.location.href = 'addauser.php';"> Edit a supplier </button>

<br><br>

<button style="background-color: orange" onclick="window.location.href = 'productlist.php';"> View products</button>
</div>

<button style="background-color: red" onclick="window.location.href = 'customerpurchase.php';"> Simulate all products being purcahsed by customers</button>




</body>
</html>





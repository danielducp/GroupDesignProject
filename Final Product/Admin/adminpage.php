<?php
  session_start() ;
    if(!isset($_SESSION['auth']))
  {
    echo"You need to login";
  header("Location:../homepage.php") ;
  }
  if($_SESSION["role"]==3){
      header('adminpage.php');
  
    } else {
      session_destroy();

      header("Location:../homepage.php") ;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>G4U</title>
  <link href="style.css" 
        rel="stylesheet" 
        type="text/css">
  <link href="Admin.css" 
        rel="stylesheet" 
        type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous">
</head>

<body style="background-color:#a6b2c1">
    <div class="topnav" ALIGN="center">  
        <img src="g4uimageprototype.png" alt="G4ULogo"  width="12.5%"></img>
        <input type="text" placeholder="Search.." style="margin-top: 100px;">        
        <button id="search-button" class="btn btn-success">Search!</button>        
        <button id="basket-button" class="btn btn-warning">Basket</button>            
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div>

    <div class="container" ALIGN="center">
        <div class="row" style="padding-top:35px;">
          <div class="col-sm"ALIGN="center">
            <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/addauser.php';">View All Products</button>
          </div> 
          <div class="col-sm"ALIGN="center">
            <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Product/addaproduct.php';">Add Product</button>
          </div>

          <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Product/ShowProducts.php';">Show Products</button>
            </div>
          <div class="col-sm"ALIGN="center">
            <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Product/editaproduct.php';">Edit Product</button>
          </div>
          <div class="col-sm"ALIGN="center">
            <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Product/removeaproduct.php';">Remove Product</button>
          </div>
        </div>
        <div class="row" style="padding-top:35px;">
            <div class="col" ALIGN="center">
              <button class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/User/addauser.php';">Add User</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/User/ShowUsers.php';">Show User</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/User/removeauser.php';">Remove User</button>
            </div>
         
          </div>
          <div class="row" style="padding-top:35px;">
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Supplier/addasupplier.php';">Add Supplier</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Supplier/ShowSuppliers.php';">Show Supplier</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Supplier/editasupplier.php';">Edit Supplier</button>
            </div>
              <div class="col" ALIGN="center">
                <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Supplier/deleteasupplier.php';">Delete Supplier!</button>
              </div> 
            </div>
            <br>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/Category/ShowCategories.php';">Show Categories</button>
            </div>     <br>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success adminButton"  onclick="window.location.href = 'AdminPermissions/SuppliedProducts/ShowSuppliedProducts.php';">Show Supplied Products</button>
            </div>     <br>
            <div class="col" ALIGN="center">
                <button  class="btn btn-success adminButton"  onclick="window.location.href = 'SystemReport.php';">System Reports</button>
              </div> 
          </div>
    </div>

    
</body>


</html>
 
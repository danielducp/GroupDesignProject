<!DOCTYPE html>
<html>
<head>
  <title>G4U</title>
  <link href="style.css" 
        rel="stylesheet" 
        type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous">
</head>

<body style="background-color:#a6b2c1">
    <div class="topnav" ALIGN="center">  
        <button  class="btn btn-warning">Back</button>
        <img src="g4uimageprototype.png" alt="G4ULogo"  width="12.5%"></img>
              
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div>

    <div class="container" ALIGN="center">
      
        <div class="row" style="padding-top:35px;">
            <div class="col" ALIGN="center">
              <button class="btn btn-success">Low Stock</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success"  onclick="window.location.href = 'PendingOrders.php';">Pending Orders</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success">List of Products</button>
            </div>
         
          </div>
          <div class="row" style="padding-top:35px;">
            <div class="col" ALIGN="center">
              <button  class="btn btn-success">Close to Low Stock</button>
            </div>
            <div class="col" ALIGN="center">
              <button  class="btn btn-success">Past Orders</button>
            </div>
              <div class="col" ALIGN="center">
                <button  class="btn btn-success">List Of Suppliers</button>
                
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
            <div class="col" ALIGN="center">
              <button  class="btn btn-success">Past Orders</button>
            </div>
              <div class="col" ALIGN="center">
                <button  class="btn btn-success">List Of Suppliers</button>
              </div> 
          </div>
    </div>

    
</body>


</html>
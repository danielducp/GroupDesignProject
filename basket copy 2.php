<html>
<head>
    <link href="style.css" 
          rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
</head>
<body style="background-color:#a6b2c1">
    <div class="topnav" ALIGN="center">  
        <button id="logout-button" class="btn btn-danger">Back</button> 
        <img src="g4uimageprototype.png" alt="G4ULogo"  width="12.5%"></img>
        <input type="text" placeholder="Search.." style="margin-top: 100px;">  
             
        <button id="search-button" class="btn btn-success">Search!</button>        
        <button id="basket-button" class="btn btn-warning">Basket</button>            
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4" style="background-color:white;">

            
            <?php
require ("config.php");

$SuppliedProductsID=$_GET['SuppliedProductsID'];
$sqlQuery = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE SuppliedProductsID = :SuppliedProductsID');
$sqlQuery->execute(['SuppliedProductsID' => $SuppliedProductsID]);

;

while($row = $sqlQuery->fetch())
{
    
echo "<TC>";
echo "You have chosen to purchase the ".$row['ProductName'];
echo ", ".$row['ProductCode'];
echo "<br>From the following Supplier: ".$row['SupplierName'];



?>
            </div>
            <div class="col-sm-1" style="background-color:white;">
                <button id="reduce-button" class="btn btn-success">-</button>
            </div>
            <div class="col-sm-1" style="background-color:white;">
                <p>0</p>
            </div>
            <div class="col-sm-1" style="background-color:white;">
                <button id="increase-button" class="btn btn-success">+</button>
            </div>
            <div class="col-sm-2" style="background-color:white;">
                <button id="remove-button" class="btn btn-success">Remove</button>         
            </div>
            <div class="col-sm-2" style="background-color:white;">  
                <p><br><?php echo "Price: £".$row['TotalCost'];}?>
</p>     
             
            </div>
            <div class="col-sm-1">
                <button id="confirm-button" class="btn btn-success">Confirm Order</button>      
            </div>
        </div>
      </div>
    </div>





</body>
</html>
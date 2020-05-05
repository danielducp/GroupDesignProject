<head>
<title>G4U</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="Admin.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color:#a6b2c1">
  <div class="topnav" ALIGN="center">
    <img src="g4uimageprototype.png" alt="G4ULogo" width="12.5%"></img>
    <input type="text" placeholder="Search.." style="margin-top: 100px;">
    <button id="search-button" class="btn btn-success">Search!</button>
    <button id="basket-button" class="btn btn-warning">Basket</button>
    <button id="logout-button" class="btn btn-danger">Log Out!</button>
  </div>

<?php 
       require ("config.php");
      
    $sql = "SELECT distinct orderedproducts.OrderID FROM `suppliedorder` INNER JOIN `order` ON suppliedorder.OrderID = `order`.OrderID 
    INNER JOIN supplier ON suppliedorder.SupplierID = supplier.SupplierID 
   INNER JOIN suppliedproducts ON suppliedorder.ProductCode = suppliedproducts.ProductCode 
   inner join orderedproducts ON `order`.OrderID = orderedproducts.OrderID WHERE OrderConfirmed = '1' AND Delivered = '0' ;
    ";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
   
    echo "<TABLE BORDER=1 width=600>";
while($row = $stmt->fetch())
{
    echo "<TD align=center>".$row['OrderID']."";




    echo "<div class=resultbutton onclick=location.href='OrderDeliveryInformation.php?OrderID=".$row['OrderID']."'>More Information</div></td>";

  }
  
?>
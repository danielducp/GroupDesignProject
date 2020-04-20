<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT *  FROM suppliedproducts  JOIN product on suppliedproducts.ProductCode = product.ProductCode WHERE CategoryID = 2  ');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Toys Product Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="stylesheet" href="../website.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#000000">
    <div style="background-color:#a6b2c1" class="topnav" align="center">
        <button id="back-button" class="btn btn-danger">Back</button>
        <img src="../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
        <button id="search-button" class="btn btn-success">Search</button>
        <button id="basket-button" class="btn btn-warning">Basket</button>
        <button id="logout-button" class="btn btn-danger">Log Out</button>
    </div>


<div class="recentlyadded content-wrapper">

    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
            <div class="column">
    <div class="card" >
    <a href="index.php?page=product&SuppliedProductsID=<?=$product['SuppliedProductsID']?>" class="product">
        <?php echo" <img class=center id=ProductImage src='pictures/".$product['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$product['ProductCode']."'" ?>
        <div class="card-body">
            <h4 class="card-title"><?php echo $product['ProductName']; ?></a></h4>
            <p class="card-title"><?php echo $product['SupplierName']; ?></a></p>

        </div>
    </div>
</div>
        <?php endforeach; ?>
    </div>
</div>


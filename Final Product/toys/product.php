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
<body style="background-color:#AEB9C7">
  <div class="topnav" style="background-color:#a6b2c1;" align="center" >
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
  <br>
<?php

// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM product INNER JOIN suppliedproducts ON product.ProductCode = suppliedproducts.ProductCode ?,?  group by suppliedproducts.SuppliedProductsID');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of products
$total_products = $pdo->query('SELECT * FROM product')->rowCount();
?>


        <?php foreach ($products as $product): ?>
        <a href="index.php?page=product&ProductCode=<?=$product['ProductCode']?>" class="product">
            <img src="pictures/<?=$product['ProductImage']?>" width="200" height="200" alt="<?=$product['ProductName']?>">
            <span class="ProductName"><?=$product['ProductName']?></span>
            <span class="TotalCost">
                &pound;<?=$product['TotalCost']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&pound;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
            <h4 class="text-info">Supplier Name: <?php echo $row["SupplierName"]; ?></h4>

        </a>
        <div>

        <?php endforeach; ?>
    </div>
  
</div>


<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['ProductCode'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE suppliedproducts.ProductCode = ? ');
    $stmt->execute([$_GET['ProductCode']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        die ('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    die ('Product does not exist!');
}
?>

<div class="product content-wrapper">
<div class="container">
    <div class="row">
      <div class="col-4">    
        <div class="card">
          <a href='<?php echo "productInformation.php?ProductCode=".$product['ProductCode'].""; ?>'>
            <h4 class="card-title"><?php echo $product['ProductName']; ?></h4>
          </a>
          <?php echo" <img class=center class =ProductImage src='pictures/".$product['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$product['ProductCode']."'" ?>
          <div class="card-body">
            <?php
              echo "<align = center>Product Code: ".$product['ProductCode']."<br>";
              echo "<align = center>Product Name: ".$product['ProductName']."<br>";
              echo "<align = center>Current Stock Level: ".$product['CurrentStockLevel']."<br>";
              echo "<align = center>Low Stock Level: ".$product['LowStockLevel']."<br>";
            ?>
            
   
          </div>
        </div>


        <div class="col-8">
    <div class="card">    
      <div class="card-body">  
        <h5 class="card-title">List of Suppliers to choose from</h5>
      </div> 
    </div>   
    <br>
    <?php
      require ("config.php");
      $ProductCode=$_GET['ProductCode'];
      $sqlQuery = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE product.ProductCode = :ProductCode ');
      $sqlQuery->execute(['ProductCode' => $ProductCode]);
      while($row = $sqlQuery->fetch())
      {
    ?>
      <div class="carinfo"> 
    <?php
    ?>
        <div class="card"  style="background-color:#ffff00 ">      
          <div class="card-body">
            <h4 class="text-info">Supplier Name: <?php echo $row["SupplierName"]; ?></h4>
            <h4 class="text-info">Delivery Time: <?php echo $row["DeliveryTime"]; ?> days</h4>
            <h4 class="text-info">Supplied Products ID: <?php echo $row["SuppliedProductsID"]; ?> </h4>

            <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$row['quantity']?>" placeholder="Quantity" required>

            <input type="hidden" name="SuppliedProductsID" value="<?=$row['SuppliedProductsID']?>">
            <input type="submit"  class="btn btn-success" value="Add To Cart">
            <input type="hidden" name="ProductCode" value="<?=$row['ProductCode']?>">
            <h4 class="text-danger">£ <?php echo $row["TotalCost"]; ?></h4>
            <input type="hidden" name="ProductName" value="<?php echo $row["ProductName"]; ?>" />
            <input type="hidden" name="SupplierID" value="<?php echo $row["SupplierID"]; ?>" />

            <input type="hidden" name="SupplierName" value="<?php echo $row["SupplierName"]; ?>" />
            <input type="hidden" name="DeliveryTime" value="<?php echo $row["DeliveryTime"]; ?>" />
            <input type="hidden" name="TotalCost" value="<?php echo $row["TotalCost"]; ?>" />
            <input type="hidden" name="ProductCode" value="<?php echo $row["ProductCode"]; ?>" />

            <?php 
              if (isset($_GET["msg"]) && $_GET["msg"] == 'itemadded') {
                echo "Added Item";
              }
              if (isset($_GET["msg"]) && $_GET["msg"] == 'passwordfailed') {
                echo "Wrong Password";
              }
            ?>
          </div>
        </div>
        <br>
      </form>
    <?php } ?>


    <div>
   
    </div>
</div>

</script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search_bar").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>

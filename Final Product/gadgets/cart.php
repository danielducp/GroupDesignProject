<html>
<head>
    <link href="../style.css" 
          rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../Back.png" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../Basket.png" id="basket" alt="basket" onclick="window.location.href = 'index.php?page=cart'"></img>
        <img src="../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../logout.php'" ></img>
      
    </div><?php

// If the user clicked the add to cart button on the product page we can check for the form data 
if (isset($_POST['SuppliedProductsID'], $_POST['quantity']) && ($_POST['SuppliedProductsID']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $SuppliedProductsID = $_POST['SuppliedProductsID'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE suppliedproducts.SuppliedProductsID = ? group by suppliedproducts.SuppliedProductsID');
    $stmt->execute([$_POST['SuppliedProductsID']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($SuppliedProductsID, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$SuppliedProductsID] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$SuppliedProductsID] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($SuppliedProductsID => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && ($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $SuppliedProductsID = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (($SuppliedProductsID) && isset($_SESSION['cart'][$SuppliedProductsID]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$SuppliedProductsID] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$productsubtotal = 0.00;



// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE suppliedproducts.SuppliedProductsID IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['TotalCost'] * (int)$products_in_cart[$product['SuppliedProductsID']];
    }
}
?>


<div class="cart content-wrapper">
    <h1 style="padding-left:20px">Order Details</h1>
    <form action="index.php?page=cart" method="post">
    <div class="table-responsive">
				<table  align="center" class="table table-bordered" style="background-color:white; width:80%;">            <thead>
                <tr>
                    <td ALIGN="center" colspan="2">Product</td>
                    <td ALIGN="center">Supplier</td>
                    <td ALIGN="center">Price</td>
                    <td ALIGN="center">Quantity</td>
                    <td ALIGN="center">Remove</td>
                    <td ALIGN="center">Total</td>
                </tr>
   
   
            </thead>

            <tbody>
            
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img" ALIGN="center">
                        <a  href="index.php?page=product&ProductCode=<?=$product['ProductCode']?>">
                            <img src="pictures/<?=$product['ProductImage']?>" width="50" height="50" alt="<?=$product['ProductName']?>">
                        </a>
                    </td>
                    <td ALIGN="center" id="TableTheme">
                        <a href="index.php?page=product&ProductCode=<?=$product['ProductCode']?>"><?=$product['ProductName']?></a>
                        <br>
                     
                    </td>

                    <td id="TableTheme" class="Supplier" ALIGN="center"><?=$product['SupplierName']?></td>
                    <td id="TableTheme" class="TotalCost" ALIGN="center">&pound;<?=$product['TotalCost'] ?></td>
                    <td id="TableTheme"  class="quantity" ALIGN="center">
                        <input type="number" style="margin-top:4px; width:50px" name="quantity-<?=$product['SuppliedProductsID']?>" value="<?=$products_in_cart[$product['SuppliedProductsID']]?>" min="1" max="5" placeholder="Quantity" required>
                    </td>
                    <td id="TableTheme" class="remove" ALIGN="center">
                    <a id="remove-button" class="btn btn-success" style="margin-top:4px" href="index.php?page=cart&remove=<?=$product['SuppliedProductsID']?>" class="remove">Remove</a>
                    </td>
                    <td id="TableTheme" class="TotalCost"  ALIGN="center">&pound; <?php echo number_format ($product['TotalCost'] * $products_in_cart[$product['SuppliedProductsID']],2)?></td>
                </tr>


                <?php endforeach; ?>
                

                <tr>
                <div class="buttons">

        </div><td></td> <td ></td > <td ></td > 					
<td ></td >	<td ALIGN="center"><input type="submit" value="Update" name="update" id="update-button" class="btn btn-success"></td>
<td ></td >     </form>

<form action="index.php?page=completeorder" method="post">

                        <td ALIGN="center" >                         <div class="subtotal">
            <span class="text"  >Subtotal</span>
            <span class="price" >&pound;<?php echo number_format($subtotal,2); ?></span>
        </div><input style="margin-top:4px"  type="submit" value="Place Order" name="completeorder" id="order-button" class="btn btn-success"/>
 
						
					</tr>
                <?php endif; ?>
            </tbody>
         
        </table>
        <tr>
           
                </tr>
 
                <input type="hidden" name="ProductCode" value="<?php echo $row["ProductCode"]; ?>" />

    </form>
    <script>
    
    </script>
</div>


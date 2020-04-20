
<?php 
$loginname = $_POST["loginname"];
echo". UserID.";
session_start();
$connect = mysqli_connect("localhost", "root", "", "g4udatabase");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["SuppliedProductsID"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
                'item_id'			=>	$_GET["SuppliedProductsID"],
                'item_suppliername'			=>	$_POST["SupplierName"],
                'item_supplierdelivery'			=>	$_POST["DeliveryTime"],
				'item_name'			=>	$_POST["ProductName"],
				'item_code'			=>	$_POST["ProductCode"],

				'item_price'		=>	$_POST["TotalCost"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
            'item_id'			=>	$_GET["SuppliedProductsID"],
            'item_suppliername'			=>	$_POST["SupplierName"],
            'item_supplierdelivery'			=>	$_POST["DeliveryTime"],
			'item_name'			=>	$_POST["ProductName"],
			'item_code'			=>	$_POST["ProductCode"],

			'item_price'		=>	$_POST["TotalCost"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="javascript: history.go(-2)"</script>';
			}
		}
	}
}

?>


<?php

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
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
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
                    <td class="img">
                        <a href="index.php?page=product&SuppliedProductsID=<?=$product['SuppliedProductsID']?>">
                            <img src="pictures/<?=$product['ProductImage']?>" width="50" height="50" alt="<?=$product['ProductName']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&SuppliedProductsID=<?=$product['SuppliedProductsID']?>"><?=$product['ProductName']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['SuppliedProductsID']?>" class="remove">Remove</a>
                    </td>
                    <td class="TotalCost">&pound;<?=$product['TotalCost']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['SuppliedProductsID']?>" value="<?=$products_in_cart[$product['SuppliedProductsID']]?>" min="1" max="5" placeholder="Quantity" required>
                    </td>
                    <td class="TotalCost">&pound; <?php echo number_format ($product['TotalCost'] * $products_in_cart[$product['SuppliedProductsID']],2)?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">&pound;<?php echo number_format($subtotal,2); ?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
    <script>
    
    </script>
</div>


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
                <p>List of items go here</p>
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
                <p>Price</p>          
            </div>
            <div class="col-sm-1">
                <button id="confirm-button" class="btn btn-success">Confirm Order</button>      
            </div>
        </div>
      </div>
    </div>
</body>
</html>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table  align="center" class="table table-bordered" style="background-color:white; width:80%; align:centre">
					<tr>
						<th width="20%">Item Name</th>
                        <th width="20%">Supplier Name</th>
                        <th width="5%">Delivery Time</th>
                        <th width="5%">Quantity</th>
                        <th width="5%">Action</th>
						<th width="20%">Price</th>
						<th width="15%">Total for that Product</th>
			
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						
                        <td><?php echo $values["item_suppliername"]; ?></td>
                        <td><?php echo $values["item_supplierdelivery"]; ?> days</td>

                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td><a href="basketlist.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">                <button id="remove-button" class="btn btn-success">Remove</button>         
</span></a></td>
						<td>£ <?php echo $values["item_price"]; ?></td>
                        <td>£ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                        

					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Order Total</td>
						<td align="right">£ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
	<td><a href="orderconfirmation.php"><span class="text-danger">                <button id="remove-button" class="btn btn-success">Confirm Order</button>         
</span></a></td>
</html>


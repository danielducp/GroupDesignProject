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
<body style="background-color:#a6b2c1">
    <div class="topnav" ALIGN="center">  
        <button id="logout-button" class="btn btn-danger">Back</button> 
        <img src="../g4uimageprototype.png" alt="G4ULogo"  width="12.5%"></img>
        <input type="text" placeholder="Search.." style="margin-top: 100px;">  
             
        <button id="search-button" class="btn btn-success">Search!</button>        
        <button id="basket-button" class="btn btn-warning">Basket</button>            
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div><?php



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

    <?php 
       require ("config.php");
       $date = date('Y-m-d');
       $stmt->bindParam(':time_added', $date, PDO::PARAM_STR);
    $sql = "INSERT INTO `order` (OrderDate, DeliveryDate,TransactionID, StaffID, Deliverystatus) VALUES ($date, NULL, 0, 0, NULL)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();

?>
          
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                <?=$product['ProductName']?>
                  
                    <?=$product['SupplierName']?></td>
                    &pound;<?=$product['TotalCost'] ?></td>
                 
                        <p type="number" style="margin-top:4px" name="quantity-<?=$product['SuppliedProductsID']?>" value="<?=$products_in_cart[$product['SuppliedProductsID']]?>" min="1" max="5" placeholder="Quantity" required>
            
               
              &pound; <?php echo number_format ($product['TotalCost'] * $products_in_cart[$product['SuppliedProductsID']],2)?></td>
        
                <?php endforeach; ?>
                <tr>
                <div class="buttons">

        </div><td></td> <td ></td > <td ></td > 					

                        <td ALIGN="center" >                         <div class="subtotal">
            <span class="text"  >Subtotal</span>
            <span class="price" >&pound;<?php echo number_format($subtotal,2); ?></span>

 
						
					</tr>
                <?php endif; ?>

        <tr>
           
                </tr>
 
     
    </form>
    <script>
    
    </script>
</div>


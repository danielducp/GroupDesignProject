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
        <a href="index.php?page=product&SuppliedProductsID=<?=$product['SuppliedProductsID']?>" class="product">
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

<?=template_footer()?>

<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['SuppliedProductsID'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE suppliedproducts.SuppliedProductsID = ? group by suppliedproducts.SuppliedProductsID');
    $stmt->execute([$_GET['SuppliedProductsID']]);
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
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="pictures/<?=$product['ProductImage']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="ProductName"><?=$product['ProductName']?></h1>
        <span class="TotalCost">
            &pound;<?=$product['TotalCost']?>
      
        </span>
        <h4 class="SupplierName">Supplier Name: <?=$product['SupplierName']?></h4><br>
        <h4 class="DeliveryTime">Delivery Time: <?=$product['DeliveryTime']?></h4><br>

        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="5" placeholder="Quantity" required>
            <input type="hidden" name="SuppliedProductsID" value="<?=$product['SuppliedProductsID']?>">
            <input type="submit" value="Add To Cart">
        </form>

    </div>
</div>

<?=template_footer()?>
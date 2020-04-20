<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT *  FROM suppliedproducts  JOIN product on suppliedproducts.ProductCode = product.ProductCode WHERE CategoryID = 1  ');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>


<div class="recentlyadded content-wrapper">
    <h2>Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
            
        <a href="index.php?page=product&SuppliedProductsID=<?=$product['SuppliedProductsID']?>" class="product">
            <img src="pictures/<?=$product['ProductImage']?>" width="200" height="200" alt="<?=$product['ProductName']?>"><br>
            <span class="ProductName"><?=$product['ProductName']?></span><br>
            <span class="TotalCost">
                &pound;<?=$product['TotalCost']?>
       

            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>
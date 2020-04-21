<?php
 require 'config.php'; 

$sqlQuery = $pdo->query('SELECT *  FROM `order` INNER JOIN `orderedproducts` on `order`.OrderID = `orderedproducts`.OrderID INNER JOIN `product` ON `orderedproducts`.ProductCode = `product`.ProductCode WHERE CurrentStockLevel < LowStockLevel
');      
while($row = $sqlQuery->fetch())
{
?>
<?php
 require 'config.php'; 

$sqlQuery = $pdo->query('SELECT *  FROM `order` INNER JOIN `orderedproducts` on `order`.OrderID = `orderedproducts`.OrderID INNER JOIN `product` ON `orderedproducts`.ProductCode = `product`.ProductCode WHERE CurrentStockLevel < LowStockLevel
');      
?>

<div class="column">
<div class="card" >
    <A href='<?php echo "productInformation.php?ProductCode=".$row['ProductCode'].""; ?>'/>  
    <div class="card-body">
        <h4 class="card-title"><?php echo $row['ProductName']; ?></a></h4>
    </div>
</div>
</div>
<?php } ?>
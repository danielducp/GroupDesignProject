<?php
 require 'config.php'; 

$sqlQuery = $pdo->query('SELECT *
FROM `PRODUCT` where `product`.CurrentStockLevel < `product`.LowStockLevel
');      
while($row = $sqlQuery->fetch())
{
?>


<div class="column">
<div class="card" >
    <A href='<?php echo "productInformation.php?ProductCode=".$row['ProductCode'].""; ?>'/>  
    <div class="card-body">
        <h4 class="card-title"><?php echo $row['ProductName']; ?></a></h4>
    </div>
</div>
</div>

<?php } 

?>
<?php
echo "<div class=purchasebutton onclick=location.href='lowstockorder.php'>Complete Purchase</div>";
?>
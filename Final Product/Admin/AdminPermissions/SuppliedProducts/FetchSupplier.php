<?php
require 'config.php';
$output='';
$SupplierID=$_POST['SupplierID'];
$sqlQuery=$pdo -> prepare('SELECT DISTINCT SupplierName FROM supplier WHERE SupplierID=? ORDER BY SupplierName ASC ');
$sqlQuery ->execute([$SupplierID]);
while($row=$sqlQuery->fetch())
{
    $output .= '<option value="'.$row["SupplierName"].'">'.$row["SupplierName"].'</option>';
}

echo $output;


?>
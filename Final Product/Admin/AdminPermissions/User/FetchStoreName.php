<?php
require 'config.php';
$output='';
$storeid=$_POST['storeid'];
$sqlQuery=$pdo -> prepare('SELECT DISTINCT StoreName FROM store WHERE storeid=? ');
$sqlQuery ->execute([$storeid]);
while($row=$sqlQuery->fetch())
{
    $output .= '<option value="'.$row["StoreName"].'">'.$row["StoreName"].'</option>';
}

echo $output;


?>
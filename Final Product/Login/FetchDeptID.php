<?php
require 'config.php';
$output='';
$staffid=$_POST['staffid'];
$sqlQuery=$pdo -> prepare('SELECT DISTINCT departmentid FROM newstaff WHERE staffid=? ');
$sqlQuery ->execute([$staffid]);
while($row=$sqlQuery->fetch())
{
    $output .= '<option value="'.$row["departmentid"].'">'.$row["departmentid"].'</option>';
}

echo $output;


?>
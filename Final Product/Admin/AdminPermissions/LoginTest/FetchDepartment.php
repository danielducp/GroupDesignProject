<?php
require 'config.php';
$output='';
$StaffID=$_POST['StaffID'];
$sqlQuery=$pdo -> prepare('SELECT DISTINCT DepartmentID FROM staff WHERE StaffID=? ORDER BY StaffID ASC ');
$sqlQuery ->execute([$StaffID]);
while($row=$sqlQuery->fetch())
{
    $output .= '<option value="'.$row["DepartmentID"].'">'.$row["DepartmentID"].'</option>';
}

echo $output;


?>
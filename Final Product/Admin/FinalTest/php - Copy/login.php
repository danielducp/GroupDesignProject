<?php
/*
 * name:        PDO Login
 * author:      Jay Blanchard
 * date:        April 2015
 */

include 'pdo_connect.php';

if(isset($_POST['staffid'], $_POST['departmentid']) ) {
    $query = "SELECT `password` FROM `newstaff` WHERE `staffid` = ?";
    $params = array($_POST['staffid']);
    $results = dataQuery($query, $params);
}

$hash = $results[0]['password']; // first and only row if username exists;

echo password_verify($_POST['upassword'], $hash) ? 'yay' : 'passwword incorrect';


if (password_verify($_POST['upassword'], $hash)) {
    echo 'Password is valid!';
    
if ($_POST['departmentid']==1){
    echo"test";
} else if ($_POST['departmentid']==2)
{
    echo"test2";
}else if ($_POST['departmentid']==3)
{
    echo"test3";
}



 else {
    echo 'Invalid password.';
}
}
?>





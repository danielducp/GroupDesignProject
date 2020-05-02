<?php
/*
 * name:        PDO Register
 * author:      Jay Blanchard
 * date:        April 2015
 */

include 'pdo_connect.php';

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $upassword = password_hash($_POST['upassword'], PASSWORD_DEFAULT);

    $query = 'INSERT INTO `users` (`fname`, `lname`, `uname`, `password`) VALUES (?,?,?,?)';
    $params = array($fname, $lname, $uname, $upassword);
    $results = dataQuery($query, $params);

    // for testing only
    echo 1 == $results ? 'success' : 'failure';
}

?>

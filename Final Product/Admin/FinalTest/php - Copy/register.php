<?php
/*
 * name:        PDO Register
 * author:      Jay Blanchard
 * date:        April 2015
 */

include 'pdo_connect.php';

if(isset($_POST['submit'])) {

    $staffid = $_POST['staffid'];
    $stafftitle = $_POST['stafftitle'];
    $staffname = $_POST['staffname'];
    $staffrole = $_POST['staffrole'];
    $storeid = $_POST['storeid'];  
    $departmentid = $_POST['departmentid'];
    $upassword = password_hash($_POST['upassword'], PASSWORD_DEFAULT);

    $query = 'INSERT INTO `newstaff` (`staffid`, `stafftitle`, `staffname`, `staffrole`, `storeid`, `departmentid`,  `password`) VALUES (?,?,?,?,?,?,?)';
    $params = array($staffid, $stafftitle, $staffname, $staffrole, $storeid, $departmentid, $upassword);
    $results = dataQuery($query, $params);

    // for testing only
    echo 1 == $results ? 'success' : 'failure';
}

?>

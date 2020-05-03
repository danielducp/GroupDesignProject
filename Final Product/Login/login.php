<?php
    session_start() ;
	
		require 'config.php';

	$staffid=$_POST['staffid'];


if(isset($_POST['savecookie']))
	{
		$savecookie=$_POST['savecookie'];
	}
else 
{
    $savecookie =false;?>

  <?php
    echo"You must tick in order to login...";
}
		if($savecookie ==true)
		{
			setcookie("staffid", $_POST['staffid'], time()+3600);
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

echo password_verify($_POST['upassword'], $hash) ? 'yay' :       header("location:Homepage.php?msg=passwordfailed");
;
$_SESSION['success'] =  "Successfully Logged In";
$_SESSION['auth'] = 1 ;

if (password_verify($_POST['upassword'], $hash)) {
    echo 'Password is valid!';
    
if ($_POST['departmentid']==1){
  $_SESSION['staffid'] = $staffid;

    header('Location: ../gadgets');

     $_SESSION["role"]=1;

} else if ($_POST['departmentid']==2)
{
  $_SESSION["staffid"]=$staffid;

 header('Location: ../toys/');
  
     $_SESSION["role"]=2;


}else if ($_POST['departmentid']==3)
{
  $_SESSION["staffid"]=$staffid;

    header('Location: ../admin/adminpage.php');
       $_SESSION["role"]=3;

}



 else {
    echo 'Invalid password.';
}
}}
?>





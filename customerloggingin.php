    <?php
    session_start() ;
	
		require 'config.php';

	$StaffID=$_POST['StaffID'];
$Password=$_POST['Password'];

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
			setcookie("StaffID", $_POST['StaffID'], time()+3600);
			setcookie("Password", $_POST['Password'], time()+3600);
			 $StaffID = !empty($_POST['StaffID']) ? trim($_POST['StaffID']) : null;
    $PasswordAttempt = !empty($_POST['Password']) ? trim($_POST['Password']) : null;
    
    $sql = "SELECT * FROM staff WHERE StaffID = :StaffID";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':StaffID', $StaffID);
    
    $stmt->execute();
    

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if($user === false){

      header("location:homepage.php?msg=usernamefailed");
    } else{
  
        
       // $validPassword = Password_verify($PasswordAttempt, $user['Password']);
        
        if($PasswordAttempt == $user['Password']){
                
$_SESSION['success'] =  "Successfully Logged In";
$_SESSION['auth'] = 1 ;
if($user['departmentid'] == '1'){
  header('Location: gadgetsproductpage.php');
  $_SESSION["role"]=1;
}
else if($user['departmentid'] == '2'){
  header('Location: toysproductpage.php');
  $_SESSION["role"]=2;
}
else if($user['departmentid'] == '3'){
  header('Location: adminpage.php');
  $_SESSION["role"]=3;
}
else {
  header('Location: admin.php');
}


    }
    else
    {
   

      header("location:homepage.php?msg=passwordfailed");
        

    }
            

	
	}
		}
		

?>

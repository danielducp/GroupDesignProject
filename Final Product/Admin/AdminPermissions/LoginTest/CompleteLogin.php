<?php
    session_start() ;
	
		require 'config.php';

	$StaffID=$_POST['StaffID'];
$Password=$_POST['Password'];
$DepartmentID=$_POST['DepartmentID'];

$hash = password_hash($Password, PASSWORD_DEFAULT);

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
            setcookie("DepartmentID", $_POST['DepartmentID'], time()+3600);

			 $StaffID = !empty($_POST['StaffID']) ? trim($_POST['StaffID']) : null;
    $Password = !empty($_POST['Password']) ? trim($_POST['Password']) : null;
    $DepartmentID = !empty($_POST['DepartmentID']) ? trim($_POST['DepartmentID']) : null;

    $hash = password_hash($Password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM staff WHERE StaffID = :StaffID & Password = :Password & DepartmentID = :DepartmentID";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':StaffID', $StaffID);
    $stmt->bindValue(':Password', $Password);
    $stmt->bindValue(':DepartmentID', $DepartmentID);

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
       
   
    if(password_verify($Password, $hash)){    
     



     
          echo 'Password Matches';

      

          if($DepartmentID=="1"){header("location: www.yourpage.com/admin.php");}
          elseif($DepartmentID=="2"){header("location: www.yourpage.com/trainer.php");}
          elseif($DepartmentID=="3"){header("location: www.yourpage.com/client.php");}

              }
        }else {
            // Invalid credentials
            echo 'Password Mismatch';
        }
       
  
      
 
		
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css" type="text/css">
  <link rel="stylesheet" href="../website.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body style="background-color:#a6b2c1">
<br><br><br>
  <form action="login.php" method="post">
  <div class="container" align="center">
    <div>
      <div class="card" align="center">
        <div class="card-body" >
    <div class="form">
        <fieldset>
         
            <form name="login" action="login.php" method="post">
            <select name="staffid" id="staffid" searchable="Search here" style="font-size: 40px; padding-right: 29px; display: inline-block;">
            <option value="" selected="true" disabled="disabled">Select Supplier ID </option>
            <?php
            $data=load_staffid();
            foreach ($data as $row): 
            echo '<option value="'.$row["staffid"].'">'.$row["staffid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
            <select name="departmentid" id="departmentid" searchable="Search here" style="font-size: 40px; padding-right: 29px; display: inline-block;">
            <option value="" disabled selected>Select Department ID</option>
         
            </select><br><br>
                <input name="upassword" type="password" placeholder="Password" style="font-size: 40px; padding-right: 29px; display: inline-block;"><br>
                <div class= "loginpagearea">
          <button type="submit" style="width: 200px;  height:65px; font-size: 35px; margin-top:10px"  class="btn btn-success">Login</button>
          <img src="../LoginButton.png" id="login-button" onclick="window.location.href = 'login.php'" alt="login-button" ></img>
        </div>
        <input type="checkbox" class="largerCheckbox" name="savecookie" style="width: 40px; height: 40px; margin-left:10px;	margin-top:10px; display: inline-block"> 
          <p style="font-size:30px; display: inline-block">Tick to Login</p><br>
          <span class="psw"  style="font-size:20px">Forgot <a href="ResetPassword.php">password?</a></span>  
        </div>
            </form>
            
        </fieldset>
        </div>   </div> <?php 
      session_start() ;
    
      if (isset($_GET["msg"]) && $_GET["msg"] == 'passwordfailed') {
        echo "Wrong Password";
      }
    ?>
  </div>
  <br><br>
  <div class="container-fluid" style="padding-right:110px ; padding-top: 20px;">
    <div class="row">
      <div class="col">
        <div class="card" style="width:350px">
          <div class="card-body" >    
            <h1>DISCLAIMER</h1>
            <p>Sensitive Information entering this site means accepting terms and conditions</p>
          </div>     
        </div>
      </div>
      <img src="../g4uimageprototype.png" alt="G4ULogo"  style="width:250px; margin-right: 10px; background-color: transparent; position:relative; right:100px; top:2px;"></img>
    </div>
  </div>
</body>
</html>`


<?php function load_staffid()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT staffid FROM newstaff where staffid != "AUT123" ORDER BY staffid ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script type="text/javascript" src="./js/main.js"></script>
</body>
</html>
	<script>
$(document).ready(function(){
 $('#staffid').change(function(){

   var staff_id = $(this).val();
   $.ajax({
    url:"FetchDeptID.php",
    method:"POST",
    data:{ staffid:staff_id},
    success:function(data){
		
     $('#departmentid').html(data);
    }
   })
  
 });
});
</script>
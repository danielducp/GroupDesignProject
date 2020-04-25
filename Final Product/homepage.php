<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="HomePage.css">
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
          <label for="StaffID" style=" font-size: 40px; padding-right: 20px; display: inline-block;"><b>StaffID:</b></label>
          <input type="text" placeholder="Enter Staff ID" name="StaffID" required style="height: 50px; width: 300px; font-size: 35px; margin-right: 10px">
          <label for="Password" style="font-size: 40px; padding-right: 29px; display: inline-block;"><b>Password:</b></label>
          <input type="password" placeholder="Enter Password" name="Password" required style="height: 50px; width: 300px; font-size: 35px;"> 
        </div>
        <div class= "loginpagearea">
          <button type="submit" style="width: 200px;  height:65px; font-size: 35px; margin-top:10px"  class="btn btn-success">Login</button>
        </div>
        <div>
          <input type="checkbox" class="largerCheckbox" name="savecookie" style="width: 40px; height: 40px; margin-left:10px;	margin-top:10px; display: inline-block"> 
          <p style="font-size:30px; display: inline-block">Tick to Login</p><br>
        </div>
        <span class="psw"  style="font-size:20px">Forgot <a href="#">password?</a></span>  
      </div>
    </div>
  </form>
  <div class = "errormessage" style='text-align:center; font-weight: bold; font-size: 20px;' > 
    <?php 
      session_start() ;
      if (isset($_GET["msg"]) && $_GET["msg"] == 'usernamefailed') {
        echo "Wrong Username";
      }
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
      <img src="g4uimageprototype.png" alt="G4ULogo"  style="width:250px; margin-right: 10px; background-color: transparent; position:relative; right:100px; top:2px;"></img>
    </div>
  </div>
</body>
</html>`


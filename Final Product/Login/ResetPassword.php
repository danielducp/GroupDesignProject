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

  <div class="container" align="center">
    <div>
      <div class="card" align="center">
        <div class="card-body" >
    <div class="form">
        <fieldset>
         
            <form name="login" action="reset.php" method="post">
            <select name="staffid" id="staffid" searchable="Search here" style="font-size: 40px; padding-right: 29px; display: inline-block;">
            <option value="" selected="true" disabled="disabled">Select Staff ID </option>
            <?php
            $data=load_staffid();
            foreach ($data as $row): 
            echo '<option value="'.$row["staffid"].'">'.$row["staffid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
      
                <div class= "loginpagearea">
          <button type="submit" style="width: 200px;  height:65px; font-size: 35px; margin-top:10px"  class="btn btn-success">Login</button>
        </div>
        </div>
            </form>
            
        </fieldset>
        </div>   </div> 
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
</html> <script>
function goBack() {
  window.history.back();
}
</script>`


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


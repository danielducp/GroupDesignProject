<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register / Login</title>
    <style type="text/css">
        .form {
            width: 30%;
        }
        input[type="text"], input[type="password"] {
            width: 99%;
            height: 1.5em;
            padding-bottom: 5px;
            margin-bottom: 3px;
        }
    </style>
    
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="Admin.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body style="background-color:#a6b2c1">
  <div class="topnav" ALIGN="center">
    <img src="g4uimageprototype.png" alt="G4ULogo" width="12.5%"></img>
   
    <button id="search-button" class="btn btn-success">Search!</button>
    <button id="basket-button" class="btn btn-warning">Basket</button>
    <button id="logout-button" class="btn btn-danger">Log Out!</button>
  </div>
    <div class="form">
        <fieldset>
            <legend> REGISTER </legend>
            <form name="register" action="register.php" method="post">

                <input name="staffid" type="text" placeholder="Staff ID"><br>
                <input name="stafftitle" type="text" placeholder="Staff Title"><br>
                <input name="staffname" type="text" placeholder="Staff Name"><br>

                <input name="staffrole" type="text" placeholder="Staff Role"><br>
                <select name="storeid" id="storeid" searchable="Search here" >
            <option value="" selected="true" disabled="disabled">Select Store ID</option>
            <?php
            $data=load_storeid();
            foreach ($data as $row): 
            echo '<option value="'.$row["storeid"].'">'.$row["storeid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
            <select name="StoreName" id="StoreName" searchable="Search here" >
            <option value="" disabled selected>Store Name</option>
         </select>
                
                <select name="departmentid" id="departmentid" searchable="Search here" >
            <option value="" selected="true" disabled="disabled">Select Department ID </option>
            <?php
            $data=load_departmentid();
            foreach ($data as $row): 
            echo '<option value="'.$row["departmentid"].'">'.$row["departmentid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
               

                <input name="upassword" type="password" placeholder="please enter a password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>


    <?php function load_departmentid()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT departmentid FROM department ORDER BY departmentid ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}


?>

<?php function load_storeid()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT storeid FROM store ORDER BY storeid ASC');
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
 $('#storeid').change(function(){

   var store_id = $(this).val();
   $.ajax({
    url:"FetchStoreName.php",
    method:"POST",
    data:{ storeid:store_id},
    success:function(data){
		
     $('#StoreName').html(data);
    }
   })
  
 });
});
</script>
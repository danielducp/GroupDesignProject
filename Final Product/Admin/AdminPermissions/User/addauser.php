<!DOCTYPE html>
<html>
<head>
    <title>G4UItems</title>
    <link href="../../../style.css" 
          rel="stylesheet" 
          type="text/css">
          <link href="../../../../style.css" 
          rel="stylesheet" 
          type="text/css">
    <link href="../../../ItemsPage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
            crossorigin="anonymous">
            
</head>
<body style="background-color:#a6b2c1">
    <div class="topnav" align="center">
        <button id="back-button" class="btn btn-danger">Back</button>
        <img src="../../../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
        <button id="search-button" class="btn btn-success">Search</button>
        <button id="basket-button" class="btn btn-warning">Basket</button>
        <button id="logout-button" class="btn btn-danger">Log Out</button>
    </div>
    <br><br>
</body>
</html>
    <div class="form">
            <h1 align="center"> Add a staff memeber </h1>
            <div class="outputresults">
            <form name="register" action="register.php" method="post" align="center">
            <label for="staffid" style="width: 150px">Staff ID</label>
                <input class="form-control" style="width: 200px; display: inline-block" name="staffid" type="text" ><br>       <br>
                <label for="stafftitle" style="width: 150px">Staff Title</label>
                <input class="form-control" style="width: 200px; display: inline-block" name="stafftitle" type="text"><br>       <br>
                <label for="staffname" style="width: 150px">Staff Name</label>

                <input  class="form-control" style="width: 200px; display: inline-block" name="staffname" type="text" ><br>       <br>
                <label for="staffrole" style="width: 150px">Staff Role</label>

                <input style="width: 200px; display: inline-block" name="staffrole" type="text" #><br>       <br>
                <select class="form-control" style="width: 200px; display: inline-block" name="storeid" id="storeid" searchable="Search here" >
            <option value="" selected="true" disabled="disabled">Select Store ID</option>
            <?php
            $data=load_storeid();
            foreach ($data as $row): 
            echo '<option value="'.$row["storeid"].'">'.$row["storeid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
            <select class="form-control" style="width: 200px; display: inline-block" name="StoreName" id="StoreName" searchable="Search here" >
            <option value="" disabled selected>Store Name</option>
         </select>
                <br> <br>
                <select class="form-control" style="width: 200px; display: inline-block" name="departmentid" id="departmentid" searchable="Search here" >
            <option value="" selected="true" disabled="disabled">Select Department ID </option>
            <?php
            $data=load_departmentid();
            foreach ($data as $row): 
            echo '<option value="'.$row["departmentid"].'">'.$row["departmentid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
            <br> <br>
            <label for="password" style="width: 150px">Password</label>

                <input class="form-control" style="width: 200px; display: inline-block" name="upassword" type="password"><br> <br>
                <div style="float: none; display: inline-block">

                <input name="submit" name="register" class="form-control" type="submit">
                </div>
            </form>
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
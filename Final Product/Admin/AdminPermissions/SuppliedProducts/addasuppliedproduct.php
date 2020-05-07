<!DOCTYPE html>
<html>
<head>
  <title>G4U</title>
  <link rel="stylesheet" href="../../../style.css" type="text/css">
  <link rel="stylesheet" href="../../../website.css" type="text/css">
  <link rel="stylesheet" href="Admin.css"  type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../../../Back.png" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../../../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
       <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../logout.php'" ></img>
       </div>
    <br><br>
</body>
</html>

<?php
    session_start() ;	
    require 'config.php';   
    
    //If the POST var "register" exists (our submit button), then we can
    //assume that the user has submitted the registration form.
    if(isset($_POST['register'])){    
        //Retrieve the field values from our registration form.
        $SuppliedProductsID = !empty($_POST['SuppliedProductsID']) ? trim($_POST['SuppliedProductsID']) : null;

        $SupplierID = !empty($_POST['SupplierID']) ? trim($_POST['SupplierID']) : null;

        $SupplierName = !empty($_POST['SupplierName']) ? trim($_POST['SupplierName']) : null;
        $DeliveryTime = !empty($_POST['DeliveryTime']) ? trim($_POST['DeliveryTime']) : null;
        $ItemCost = !empty($_POST['ItemCost']) ? trim($_POST['ItemCost']) : null;
        $VATCost = !empty($_POST['VATCost']) ? trim($_POST['VATCost']) : null;
        $TotalCost = !empty($_POST['TotalCost']) ? trim($_POST['TotalCost']) : null;
        $ProductCode = !empty($_POST['ProductCode']) ? trim($_POST['ProductCode']) : null;

        //TO ADD: Error checking (stafftitle characters, staffname length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied stafftitle already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(SuppliedProductsID) AS num FROM suppliedproducts WHERE SuppliedProductsID = :SuppliedProductsID";
        $stmt = $pdo->prepare($sql);
    
        //Bind the provided stafftitle to our prepared statement.
        $stmt->bindValue(':SuppliedProductsID', $SuppliedProductsID);
        
        //Execute.
        $stmt->execute();
        
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //If the provided stafftitle already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
            die('That category already exists!');
        }    
        //Hash the staffname as we do NOT want to store our staffnames in plain text.
        //$staffnameHash = staffname_hash($pass, staffname_BCRYPT, array("cost" => 12));

        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.

        $sqlQuery = $pdo->query('SELECT SuppliedProductsID FROM suppliedproducts ORDER BY SuppliedProductsID DESC LIMIT 1');
        $row=$sqlQuery->fetch();
        $SuppliedProductsID = $row['SuppliedProductsID']+1;

        $sql = "INSERT INTO suppliedproducts (SuppliedProductsID, SupplierID, SupplierName, DeliveryTime, ItemCost, VATCost, TotalCost, ProductCode ) VALUES (:SuppliedProductsID, :SupplierID, :SupplierName, :DeliveryTime, :ItemCost, :VATCost, :TotalCost, :ProductCode )";
        $stmt = $pdo->prepare($sql);
    
        //Bind our variables.
        $stmt->bindValue( ':SuppliedProductsID', $SuppliedProductsID);   

        $stmt->bindValue( ':SupplierID', $SupplierID);   
        $stmt->bindValue( ':SupplierName', $SupplierName);   
        $stmt->bindValue( ':ProductCode', $ProductCode);   

        $stmt->bindValue(':DeliveryTime', $DeliveryTime);   
        $stmt->bindValue(':ItemCost', $ItemCost);  
        $stmt->bindValue(':VATCost', $VATCost);   
        $stmt->bindValue(':TotalCost', $TotalCost);   

        //Execute the statement and insert the new account.
        $result = $stmt->execute();


        //If the signup process is successful.
        if($result){
            //What you do here is up to you!
            echo 'Thank you for registering with our website.';
            header('location:login.php');
        }    
    } 
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">
    <meta charset="UTF-8">
    <title>Add a Category</title>
</head>
<body>
    <h1 align="center">Add a Category</h1>
    <br>
    <div class="outputresults" align="center">
    <form action="addasuppliedproduct.php" method="post">

    <label for="SupplierID" style="width: 150px">Supplier ID: </label>
    <select name="SupplierID" class="form-control" id="SupplierID" searchable="Search here" style="width: 200px; display: inline-block">
            <option value="" selected="true" disabled="disabled">Select Supplier ID </option>
            <?php
            $data=load_SupplierID();
            foreach ($data as $row): 
            echo '<option value="'.$row["SupplierID"].'">'.$row["SupplierID"].'</option>';
            ?>
            <?php endforeach ?>
            </select><br><br>
	

            <label for="SupplierName" style="width: 150px">Supplier Name: </label>
            <select name="SupplierName" class="form-control" id="SupplierName" searchable="Search here" style="width: 200px; display: inline-block">
            <option value="" disabled selected>Select Supplier Name </option>
         
            </select><br><br>
            <label for="ProductCode" style="width: 150px">Delivery Time: </label>
            <input type="number" class="form-control"  name="DeliveryTime" style="width: 200px; display: inline-block"><br><br>
            <label for="ItemCost" style="width: 150px">Item Cost: </label>
            <input type="text" class="form-control"  name="ItemCost" style="width: 200px; display: inline-block"><br><br>
            <label for="VATCost" style="width: 150px">VAT Cost: </label>
            <input type="text" class="form-control"  name="VATCost" style="width: 200px; display: inline-block"><br><br>
            <label for="TotalCost" style="width: 150px">Total Cost: </label>
            <input type="text" class="form-control"  name="TotalCost" style="width: 200px; display: inline-block"><br><br>
            <label for="ProductCode" style="width: 150px">Product Code: </label>
<select name="ProductCode" class="form-control" id="ProductCode" searchable="Search here" style="width: 200px; display: inline-block">
            <option value="" selected="true" disabled="disabled">Select Product Code </option>
            <?php
            $data=load_ProductCode();
            foreach ($data as $row): 
            echo '<option value="'.$row["ProductCode"].'">'.$row["ProductCode"].'</option>';
            ?>
            <?php endforeach ?>
            </select><br><br>


        
        <input type="submit" name="register" class="form-control" value="Register" style="width: 200px"></button>
    </form>
</body>
</html>




       

<?php function load_SupplierID()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT SupplierID FROM supplier ORDER BY SupplierID ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}


?>



<?php function load_ProductCode()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT ProductCode FROM product ORDER BY ProductCode ASC');
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
 $('#SupplierID').change(function(){

   var Supplier_ID = $(this).val();
   $.ajax({
    url:"FetchSupplier.php",
    method:"POST",
    data:{ SupplierID:Supplier_ID},
    success:function(data){
		
     $('#SupplierName').html(data);
    }
   })
  
 });
});
</script>
<!DOCTYPE html>
<html>
<head>
    <title>G4UItems</title>
    <link href="style.css" 
          rel="stylesheet" 
          type="text/css">
    <link href="ItemsPage.css" 
          rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
</head>
<body style="background-color:#a6b2c1">
    <div class="topnav" ALIGN="center">  
        <button  class="btn btn-warning">Back</button>
        <img src="g4uimageprototype.png" alt="G4ULogo" id="g4u-logo"></img>              
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div>
    <br><br><br><br><br><br>
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
    <h1>Add a Category</h1>
    <div class="outputresults">
    <form action="addasuppliedproduct.php" method="post">

    <select name="SupplierID" id="SupplierID" searchable="Search here">
            <option value="" selected="true" disabled="disabled">Select Supplier ID </option>
            <?php
            $data=load_SupplierID();
            foreach ($data as $row): 
            echo '<option value="'.$row["SupplierID"].'">'.$row["SupplierID"].'</option>';
            ?>
            <?php endforeach ?>
            </select><br>
	
            <select name="SupplierName" id="SupplierName" searchable="Search here">
            <option value="" disabled selected>Select Supplier Name </option>
         
            </select><br>
Delivery Time: <input type="number" class="form-control"  name="DeliveryTime">
Item Cost: <input type="text" class="form-control"  name="ItemCost">
VAT Cost: <input type="text" class="form-control"  name="VATCost" >
Total Cost: <input type="text" class="form-control"  name="TotalCost" >
<select name="ProductCode" id="ProductCode" searchable="Search here">
            <option value="" selected="true" disabled="disabled">Select Product Code </option>
            <?php
            $data=load_ProductCode();
            foreach ($data as $row): 
            echo '<option value="'.$row["ProductCode"].'">'.$row["ProductCode"].'</option>';
            ?>
            <?php endforeach ?>
            </select>


        
        <input type="submit" name="register" class="form-control" value="Register"></button>
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
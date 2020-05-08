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
        $ProductCode = !empty($_POST['ProductCode']) ? trim($_POST['ProductCode']) : null;
        $ProductName = !empty($_POST['ProductName']) ? trim($_POST['ProductName']) : null;
        $ProductImage = !empty($_POST['ProductImage']) ? trim($_POST['ProductImage']) : null;
        $QuantityPerPack = !empty($_POST['QuantityPerPack']) ? trim($_POST['QuantityPerPack']) : null;
        $CategoryID = !empty($_POST['CategoryID']) ? trim($_POST['CategoryID']) : null;
        $CurrentStockLevel = !empty($_POST['CurrentStockLevel']) ? trim($_POST['CurrentStockLevel']) : null;
        $LowStockLevel = !empty($_POST['LowStockLevel']) ? trim($_POST['LowStockLevel']) : null;
       


        //TO ADD: Error checking (ProductName characters, ProductImage length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied ProductName already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(ProductCode) AS num FROM product WHERE ProductCode = :ProductCode";
        $stmt = $pdo->prepare($sql);
        
        //Bind the provided ProductName to our prepared statement.
        $stmt->bindValue(':ProductCode', $ProductCode);
        
        //Execute.
        $stmt->execute();
        
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //If the provided ProductName already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
            die('That ProductName already exists!');
        }
        
        //Hash the ProductImage as we do NOT want to store our ProductImages in plain text.

        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO product (ProductCode, ProductName, ProductImage, QuantityPerPack, CategoryID, CurrentStockLevel, LowStockLevel ) VALUES (:ProductCode, :ProductName, :ProductImage, :QuantityPerPack, :CategoryID, :CurrentStockLevel, :LowStockLevel)";
        $stmt = $pdo->prepare($sql);
       
        //Bind our variables.

        $stmt->bindValue(':ProductCode', $ProductCode);
        $stmt->bindValue(':ProductName', $ProductName);
        $stmt->bindValue(':ProductImage', $ProductImage);

        $stmt->bindValue(':QuantityPerPack', $QuantityPerPack);
        $stmt->bindValue(':CategoryID', $CategoryID);
        $stmt->bindValue(':CurrentStockLevel', $CurrentStockLevel);
        $stmt->bindValue(':LowStockLevel', $LowStockLevel);

        //Execute the statement and insert the new account.
        $result = $stmt->execute();
        
        //If the signup process is successful.
        if($result){
            //What you do here is up to you!
            echo 'Thank you for adding a product.';
            header('Refresh: 5; URL=../../adminpage.php');
        }        
    } 
?>

<!DOCTYPE html>
<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../../../../style.css">
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1 align="center">Add a Product</h1>
        <div class="outputresults">
        <form action="addaproduct.php" method="post" align="center">
            <label for="ProductID" style="width: 150px">Product ID</label>
            <input type="text" id="ProductID" name="ProductID" class="form-control" maxlength="20" style="width: 200px; display: inline-block">
            <br><br>
            <label for="ProductCode" style="width: 150px">Product Code</label>
            <input type="ProductCode" id="ProductCode" class="form-control" name="ProductCode" style="width: 200px; display: inline-block">
            <br><br>
            <label for="ProductName" style="width: 150px">Product Name</label>
            <input type="ProductName" id="ProductName" class="form-control" name="ProductName" minlength="2" maxlength="20" style="width: 200px; display: inline-block">
            <br><br>
            <label for="ProductImage" style="width: 150px">Product Image</label>
            <input type="file" id="ProductImage" class="form-control" name="ProductImage" style="width: 200px; display: inline-block">
            <br><br>
            <label for="QuantityPerPack" style="width: 150px">Quantity Per Pack</label>
            <input type="number"  min="1" max="5" id="QuantityPerPack"  class="form-control" name="QuantityPerPack"  maxlength="7" style="width: 200px; display: inline-block">
            <br><br>
            <label for="CategoryID" style="width: 150px">Category ID</label>
            <input type="number" min="1" max="5" id="CategoryID" name="CategoryID" class="form-control" maxlength="11" style="width: 200px; display: inline-block">
            <br><br>
            <label for="CurrentStockLevel" style="width: 150px">Current Stock Level</label>
            <input type="text" id="CurrentStockLevel" name="CurrentStockLevel" class="form-control" maxlength="11" style="width: 200px; display: inline-block">
            <br><br>
            <label for="LowStockLevel" style="width: 150px">Low Stock Level</label>
            <input type="text" id="LowStockLevel" name="LowStockLevel" class="form-control" maxlength="11" style="width: 200px; display: inline-block">
            <br><br>
            <div style="float: none; display: inline-block">
                <input type="submit" name="register" class="form-control" value="Register" style="width: 120px"></button>
            </div>
        </form>
    </body>
</html>
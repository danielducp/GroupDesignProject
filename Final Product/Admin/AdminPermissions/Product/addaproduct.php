<!DOCTYPE html>
<html>
<head>
    <title>G4UItems</title>
    <link href="style.css" 
          rel="stylesheet" 
          type="text/css">
    <link href="ItemsPage.css" rel="stylesheet">
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
        <title>Register</title>
    </head>
    <body>
        <h1>Add a Product</h1>
		<div class="outputresults">
        <form action="addaproduct.php" method="post">
			<label for="ProductCode">Product Code</label>
            <input type="text" id="ProductCode" name="ProductCode" class="form-control" maxlength="6"><br>
            <label for="ProductName">Product Name</label>
            <input type="text" id="ProductName" class="form-control" name="ProductName"><br>
            <label for="ProductImage">Product Image</label>
            <input type="text" id="ProductImage" class="form-control" name="ProductImage"><br>
            <label for="QuantityPerPack">Quantity Per Pack</label>
            <input type="text" id="QuantityPerPack" class="form-control" name="QuantityPerPack"><br>
            <label for="CategoryID">Category ID</label>
            <input type="text" id="CategoryID" class="form-control" name="CategoryID"><br>
            <label for="CurrentStockLevel">Current Stock Level</label>
            <input type="text" id="CurrentStockLevel" class="form-control" name="CurrentStockLevel"><br>
            <label for="LowStockLevel">Low Stock Level</label>
            <input type="text" id="LowStockLevel" class="form-control" name="LowStockLevel"><br>
            <input type="submit" name="register" class="form-control" value="Register"></button>
        </form>
    </body>
</html>
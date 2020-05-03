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
    <div class="topnav" align="center">
        <button id="back-button" class="btn btn-danger">Back</button>
        <img src="g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
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

<?php
    session_start() ;	
    require 'config.php';    
    
    //If the POST var "register" exists (our submit button), then we can
    //assume that the user has submitted the registration form.
    if(isset($_POST['register'])){    
        //Retrieve the field values from our registration form.
	    $staffid = !empty($_POST['ProductID']) ? trim($_POST['ProductID']) : null;
        $ProductCode = !empty($_POST['ProductCode']) ? trim($_POST['ProductCode']) : null;
        $staffname = !empty($_POST['ProductName']) ? trim($_POST['ProductName']) : null;
        $staffrole = !empty($_POST['ProductImage']) ? trim($_POST['ProductImage']) : null;
	    $QuantityPerPack = !empty($_POST['QuantityPerPack']) ? trim($_POST['QuantityPerPack']) : null;
        $CategoryID = !empty($_POST['CategoryID']) ? trim($_POST['CategoryID']) : null;
        $CurrentStockLevel = !empty($_POST['CurrentStockLevel']) ? trim($_POST['CurrentStockLevel']) : null;
        $LowStockLevel = !empty($_POST['LowStockLevel']) ? trim($_POST['LowStockLevel']) : null;
        //TO ADD: Error checking (stafftitle characters, staffname length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied stafftitle already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(ProductID) AS num FROM product WHERE ProductID = :ProductID";
        $stmt = $pdo->prepare($sql);
        
        //Bind the provided stafftitle to our prepared statement.
        $stmt->bindValue(':ProductID', $ProductID);
        
        //Execute.
        $stmt->execute();
        
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //If the provided stafftitle already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
            die('That product already exists!');
        }
        
        //Hash the staffname as we do NOT want to store our staffnames in plain text.
        //$staffnameHash = staffname_hash($pass, staffname_BCRYPT, array("cost" => 12));
        $sqlQuery = $pdo->query('SELECT ProductID FROM product ORDER BY ProductID DESC LIMIT 1');
        $row=$sqlQuery->fetch();
        $staffnumber = $row['ProductID']+1;
        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO product (ProductID, ProductCode, ProductName, Productimage, QuantityPerPack, CategoryID, CurrentStockLevel, LowStockLevel) VALUES (:ProductID, :ProductCode, :ProductName, :ProductImage, :QuantityPerPack, :CategoryID, :CurrentStockLevel, :LowStockLevel)";
        $stmt = $pdo->prepare($sql);
        
        //Bind our variables.
        $stmt->bindValue(':ProductID', $ProductID);    
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
    <h1 align="center">Add a Product</h1>
    <div class="outputresults">
    <form action="addauser.php" method="post" align="center">
        <div style="float: none; display: inline-block">
            <label for="ProductID">Product ID</label>
            <input type="text" id="ProductID" name="ProductID" class="form-control" maxlength="20" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <label for="ProductCode">Product Code</label>
            <input type="ProductCode" id="ProductCode" class="form-control" name="ProductCode" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <label for="ProductName">Product Name</label>
            <input type="ProductName" id="ProductName" class="form-control" name="ProductName" minlength="2" maxlength="20" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <label for="ProductImage">Product Image</label>
            <input type="text" id="ProductImage" class="form-control" name="ProductImage" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <label for="QuantityPerPack">Quantity Per Pack</label>
            <input type="number"  min="1" max="5" id="QuantityPerPack"  class="form-control" name="QuantityPerPack"  maxlength="7" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <label for="CategoryID">Category ID</label>
            <input type="number" min="1" max="5" id="CategoryID" name="CategoryID" class="form-control" maxlength="11" style="width: 200px">
        </div>
        <br><br>
            <div style="float: none; display: inline-block">
            <label for="CurrentStockLevel">Current Stock Level</label>
        <input type="text" id="CurrentStockLevel" name="CurrentStockLevel" class="form-control" maxlength="11" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <label for="LowStockLevel">Low Stock Level</label>
            <input type="text" id="LowStockLevel" name="LowStockLevel" class="form-control" maxlength="11" style="width: 200px">
        </div>
        <br><br>
        <div style="float: none; display: inline-block">
            <input type="submit" name="register" class="form-control" value="Register"></button>
        </div>
    </form>
</body>
</html>
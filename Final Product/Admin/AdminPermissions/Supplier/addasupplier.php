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
        $SupplierID = !empty($_POST['SupplierID']) ? trim($_POST['SupplierID']) : null;
        $SupplierName = !empty($_POST['SupplierName']) ? trim($_POST['SupplierName']) : null;
        $SupplierAddress = !empty($_POST['SupplierAddress']) ? trim($_POST['SupplierAddress']) : null;
       

        //TO ADD: Error checking (SupplierName characters, SupplierAddress length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied SupplierName already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(SupplierID) AS num FROM supplier WHERE SupplierID = :SupplierID";
        $stmt = $pdo->prepare($sql);
        
        //Bind the provided SupplierName to our prepared statement.
        $stmt->bindValue(':SupplierID', $SupplierID);
        
        //Execute.
        $stmt->execute();
        
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //If the provided SupplierName already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
            die('That SupplierName already exists!');
        }
        
        //Hash the SupplierAddress as we do NOT want to store our SupplierAddresss in plain text.

        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO supplier (SupplierID, SupplierName, SupplierAddress) VALUES (:SupplierID, :SupplierName, :SupplierAddress)";
        $stmt = $pdo->prepare($sql);
       
        //Bind our variables.

        $stmt->bindValue(':SupplierID', $SupplierID);
        $stmt->bindValue(':SupplierName', $SupplierName);
        $stmt->bindValue(':SupplierAddress', $SupplierAddress);
     
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
        <h1>Add a supplier</h1>
		<div class="outputresults">
        <form action="addasupplier.php" method="post">
			<label for="SupplierID">Supplier ID</label>
            <input type="text" id="SupplierID" name="SupplierID" class="form-control" maxlength="2"><br>
            <label for="SupplierName">Supplier Name</label>
            <input type="text" id="SupplierName" class="form-control" name="SupplierName"><br>
            <label for="SupplierAddress">Supplier Address</label>
            <input type="text" id="SupplierAddress" class="form-control" name="SupplierAddress"><br>
			
            <input type="submit" name="register" class="form-control" value="Register"></button>
        </form>
    </body>
</html>
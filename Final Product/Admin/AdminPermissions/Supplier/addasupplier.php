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
        
        <img src="../../../Back.png" onclick="goBack()" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../../../g4uimageprototype.png" onclick="window.location.href = '../../adminpage.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
       </div>
    <br><br>
</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>

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
            echo 'Thank you for adding a supplier.';
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
        <h1 align="center">Add a Supplier</h1>
        <br>
		<div class="outputresults">
        <form action="addasupplier.php" method="post" align="center">
            <label for="SupplierCode" style="width: 150px">Supplier Code</label>
            <input type="text" id="SupplierCode" name="SupplierCode" class="form-control" maxlength="20" style="width: 200px; display: inline-block">
            <br><br>
            <label for="SupplierID" style="width: 150px">Supplier ID</label>
            <input type="SupplierID" id="SupplierID" class="form-control" name="SupplierID" style="width: 200px; display: inline-block">
            <br><br>
            <label for="SupplierName" style="width: 150px">Supplier Name</label>
            <input type="SupplierName" id="SupplierName" class="form-control" name="SupplierName" minlength="2" maxlength="20" style="width: 200px; display: inline-block">
            <br><br>
            <label for="SupplierAddress" style="width: 150px">Supplier Address</label>
            <input type="text" id="SupplierAddress" class="form-control" name="SupplierAddress" style="width: 200px; display: inline-block">
            <br><br>
            <div style="float: none; display: inline-block">			
                <input type="submit" name="register" class="form-control" value="Register"></button>
            </div>
        </form>
    </body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>
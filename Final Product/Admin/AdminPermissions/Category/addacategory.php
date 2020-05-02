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
 
        $CategoryID = !empty($_POST['CategoryID']) ? trim($_POST['CategoryID']) : null;
        $CategoryName = !empty($_POST['CategoryName']) ? trim($_POST['CategoryName']) : null;
        //TO ADD: Error checking (stafftitle characters, staffname length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied stafftitle already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(CategoryID) AS num FROM category WHERE CategoryID = :CategoryID";
        $stmt = $pdo->prepare($sql);
    
        //Bind the provided stafftitle to our prepared statement.
        $stmt->bindValue(':CategoryID', $CategoryID);
        
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
        $sql = "INSERT INTO category (CategoryID, CategoryName) VALUES (:CategoryID, :CategoryName)";
        $stmt = $pdo->prepare($sql);
    
        //Bind our variables.

        $stmt->bindValue(':CategoryID', $CategoryID);
        $stmt->bindValue(':CategoryName', $CategoryName);    
        
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
    <form action="addacategory.php" method="post">
        <label for="CategoryID">Category ID</label>
        <input type="text" id="CategoryID" name="CategoryID" class="form-control" maxlength="20"><br>
        <label for="CategoryName">Category Name</label>
        <input type="number" id="CategoryName" class="form-control" name="CategoryName"><br>        
        <input type="submit" name="register" class="form-control" value="Register"></button>
    </form>
</body>
</html>
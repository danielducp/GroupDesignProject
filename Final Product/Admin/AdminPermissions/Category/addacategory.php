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
        <img onclick="window.location.href = '../../adminpage.php'" src="../../../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
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
            echo 'Thank you for adding a catgeory.';
            header('Refresh: 5; URL=../../adminpage.php');
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
    <form action="addacategory.php" method="post">
        <label for="CategoryID" style="width: 150px">Category ID</label>
        <input type="number" id="CategoryID" name="CategoryID" class="form-control"  style="width: 200px; display: inline-block"><br>
        <label for="CategoryName" style="width: 150px">Category Name</label>
        <input type="test" id="CategoryName" class="form-control" name="CategoryName" style="width: 200px; display: inline-block"><br><br>        
        <input type="submit" name="register" class="form-control" value="Register" style="width: 120px"></button>
    </form>
</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>
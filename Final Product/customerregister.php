<!DOCTYPE html>
<html>
<head>	  <link rel="stylesheet" href="../main.css">
	<link rel="stylesheet" type="text/css" href="style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark fluid">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">
    <img src="logo.png" alt="logo" style="width:80px;">
  </a>
  
  <div class >
 <h1> Automobile Trader </h1>
  </div>
  <!-- Links -->
  
 <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="../testing.html">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../searchCars.php">Search Cars</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
	
	  
  </ul>
</nav>

<?php

session_start();
 
/**
 * Include ircmaxell's password_compat library.
 */
require 'lib/password.php';
 
/**
 * Include our MySQL connection.
 */
require 'connect.php';
 
 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
	    $firstname = !empty($_POST['firstname']) ? trim($_POST['firstname']) : null;
	    $lastname = !empty($_POST['lastname']) ? trim($_POST['lastname']) : null;

    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    	    $address = !empty($_POST['address']) ? trim($_POST['address']) : null;
	    $postcode = !empty($_POST['postcode']) ? trim($_POST['postcode']) : null;
	$phonenumber = !empty($_POST['phonenumber']) ? trim($_POST['phonenumber']) : null;

    //TO ADD: Error checking (email characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied email already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(email) AS num FROM customers WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided email to our prepared statement.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided email already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That email already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
//    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO customers (firstname, lastname, email, password, address, postcode, phonenumber) VALUES (:firstname, :lastname, :email, :password, :address, :postcode, :phonenumber)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
	     $stmt->bindValue(':firstname', $firstname);    
	 $stmt->bindValue(':lastname', $lastname);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
     $stmt->bindValue(':address', $address);    
	 $stmt->bindValue(':postcode', $postcode);
	$stmt->bindValue(':phonenumber', $phonenumber);

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
        <h1>Register</h1>
		<div class="outputresults">

        <form action="customerregister.php" method="post">
			<label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" class="form-control"  maxlength="20"><br>
			<label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" class="form-control" maxlength="20"><br>
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" name="email"><br>
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" minlength="2" maxlength="20"><br>
			<label for="address">Address</label>
            <input type="text" id="address" class="form-control" name="address"><br>
			<label for="postcode">Postcode</label>
            <input type="text" id="postcode" class="form-control" name="postcode"  maxlength="7"><br>
					<label for="phonenumber">Phone Number</label>
            <input type="text" id="phonenumber" name="phonenumber" class="form-control" maxlength="11"><br>
            <input type="submit" name="register" class="form-control" value="Register"></button>
        </form>
    </body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>
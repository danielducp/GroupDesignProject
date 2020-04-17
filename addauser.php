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
        $staffid = !empty($_POST['staffid']) ? trim($_POST['staffid']) : null;
        $stafftitle = !empty($_POST['stafftitle']) ? trim($_POST['stafftitle']) : null;
        $staffname = !empty($_POST['staffname']) ? trim($_POST['staffname']) : null;
        $staffrole = !empty($_POST['staffrole']) ? trim($_POST['staffrole']) : null;
        $storeid = !empty($_POST['storeid']) ? trim($_POST['storeid']) : null;
        $departmentid = !empty($_POST['departmentid']) ? trim($_POST['departmentid']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

        //TO ADD: Error checking (stafftitle characters, staffname length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied stafftitle already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(staffid) AS num FROM staff WHERE staffid = :staffid";
        $stmt = $pdo->prepare($sql);
        
        //Bind the provided stafftitle to our prepared statement.
        $stmt->bindValue(':staffid', $staffid);
        
        //Execute.
        $stmt->execute();
        
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //If the provided stafftitle already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
            die('That stafftitle already exists!');
        }
        
        //Hash the staffname as we do NOT want to store our staffnames in plain text.
        //$staffnameHash = staffname_hash($pass, staffname_BCRYPT, array("cost" => 12));
        $sqlQuery = $pdo->query('SELECT staffnumber FROM staff ORDER BY staffnumber DESC LIMIT 1');
        $row=$sqlQuery->fetch();
        $staffnumber = $row['staffnumber']+1;
        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO staff (staffnumber, staffid, stafftitle, staffname, staffrole, storeid, departmentid, password) VALUES (:staffnumber, :staffid, :stafftitle, :staffname, :staffrole, :storeid, :departmentid, :password)";
        $stmt = $pdo->prepare($sql);
        
        //Bind our variables.
        $stmt->bindValue(':staffnumber', $staffnumber);    
        $stmt->bindValue(':staffid', $staffid);
        $stmt->bindValue(':stafftitle', $stafftitle);
        $stmt->bindValue(':staffname', $staffname);
        $stmt->bindValue(':staffrole', $staffrole);    
        $stmt->bindValue(':storeid', $storeid);
        $stmt->bindValue(':departmentid', $departmentid);
        $stmt->bindValue(':password', $password);
        
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
        <h1>Add a staff member</h1>
		<div class="outputresults">
        <form action="addauser.php" method="post">
			<label for="staffid">Staff ID</label>
            <input type="text" id="staffid" name="staffid" class="form-control" maxlength="20"><br>
            <label for="stafftitle">Staff Title</label>
            <input type="stafftitle" id="stafftitle" class="form-control" name="stafftitle"><br>
            <label for="staffname">Staff Name</label>
            <input type="staffname" id="staffname" class="form-control" name="staffname" minlength="2" maxlength="20"><br>
			<label for="staffrole">Staff Role</label>
            <input type="text" id="staffrole" class="form-control" name="staffrole"><br>
			<label for="storeid">Store ID</label>
            <input type="number"  min="1" max="5" id="storeid"  class="form-control" name="storeid"  maxlength="7"><br>
            <label for="departmentid">Department ID</label>
            <input type="number" min="1" max="5" id="departmentid" name="departmentid" class="form-control" maxlength="11"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" class="form-control" maxlength="11"><br>
            <input type="submit" name="register" class="form-control" value="Register"></button>
        </form>
    </body>
</html>
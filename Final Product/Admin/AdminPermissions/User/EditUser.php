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
        <img src="../../../g4uimageprototype.png" id="g4u-logo" onclick="window.location.href = '../../adminpage.php'"  alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
       </div>


<div class="outputresults">



<?php
$staffid = $_GET['staffid'];

$host = 'localhost';
$db   = 'g4udatabase';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [    
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    
PDO::ATTR_EMULATE_PREPARES   => false,];

try 
{    
	$pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{     
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sqlQuery = $pdo->prepare('SELECT * FROM newstaff WHERE staffid = ?');
$sqlQuery->execute([$staffid]);

while($row = $sqlQuery->fetch())
{
?>



	
<br>
<fieldset>
            <legend align="center"> REGISTER </legend> <br>
            <form name="register" action="UpdateUser.php" method="post" align="center">
                <label for="staffid" style="width: 150px">Staff ID: </label>
                <input name="staffid" class="form-control" type="text" readonly value="<?php echo $row['staffid'];?>" style="width: 300px; display: inline-block"><br><br>
                <label for="stafftitle" style="width: 150px">Staff Title: </label>
				<input name="stafftitle" class="form-control" type="text" value="<?php echo $row['stafftitle'];?>" style="width: 300px; display: inline-block"><br><br>
                <label for="staffname" style="width: 150px">Staff Name: </label>
				<input name="staffname" class="form-control" type="text"  value="<?php echo $row['staffname'];?>" style="width: 300px; display: inline-block"><br><br>
                <label for="staffrole" style="width: 150px">Staff Role: </label>
				<input name="staffrole" class="form-control" type="text" value="<?php echo $row['staffrole'];?>" style="width: 300px; display: inline-block"><br><br>
                <label for="storeid" style="width: 150px">Store ID: </label>
				<input name="storeid" class="form-control" type="text"  value="<?php echo $row['storeid'];?>" style="width: 300px; display: inline-block"><br><br>
                <label for="departmentid" style="width: 150px">Department ID: </label>
				<input name="departmentid" class="form-control" type="text" value="<?php echo $row['departmentid'];?>" style="width: 300px; display: inline-block"><br><br>
                <label for="password" style="width: 150px">Password: </label>
                <input name="upassword" class="form-control" type="password" placeholder="please enter a password or passphrase" style="width: 300px; display: inline-block"><br><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
</form>

<?php 
}
?>

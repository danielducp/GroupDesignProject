<head>
<title>G4U</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="Admin.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color:#a6b2c1">
  <div class="topnav" ALIGN="center">
    <img src="g4uimageprototype.png" alt="G4ULogo" width="12.5%"></img>
    <input type="text" placeholder="Search.." style="margin-top: 100px;">
    <button id="search-button" class="btn btn-success">Search!</button>
    <button id="basket-button" class="btn btn-warning">Basket</button>
    <button id="logout-button" class="btn btn-danger">Log Out!</button>
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



	

<fieldset>
            <legend> REGISTER </legend>
            <form name="register" action="UpdateUser.php" method="post">

                <input name="staffid" type="text" readonly value="<?php echo $row['staffid'];?>"><br>
				<input name="stafftitle" type="text" value="<?php echo $row['stafftitle'];?>"><br>
				<input name="staffname" type="text"  value="<?php echo $row['staffname'];?>"><br>
				<input name="staffrole" type="text" value="<?php echo $row['staffrole'];?>"><br>
				<input name="storeid" type="text"  value="<?php echo $row['storeid'];?>"><br>
				<input name="departmentid" type="text" value="<?php echo $row['departmentid'];?>"><br>

               

                <input name="upassword" type="password" placeholder="please enter a password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
</form>

<?php 
}
?>

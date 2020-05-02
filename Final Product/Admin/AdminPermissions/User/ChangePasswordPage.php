


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
            <form name="register" action="ChangeUserPassword.php" method="post">

                <input name="staffid" type="text" readonly value="<?php echo $row['staffid'];?>"><br>
          
               

                <input name="upassword" type="password" placeholder="please enter a password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
</form>

<?php 
}
?>

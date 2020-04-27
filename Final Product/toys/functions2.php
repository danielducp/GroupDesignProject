<?php 

function loggedInUsername($row) {
	require_once'connect.php';

$sql= "SELECT username FROM users WHERE id = " . $_SESSION['user_id'];
$stmt = $pdo->query($sql); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}
 ?>
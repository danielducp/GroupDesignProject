<html>
<head>
    <link href="../style.css" 
          rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../Back.png" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../Basket.png" id="basket" alt="basket" onclick="window.location.href = 'index.php?page=cart'"></img>
        <img src="../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../logout.php'" ></img>
        <button id="logout"  onclick="window.location.href = '../logout.php'" class="btn btn-danger">Log Out</button>
    </div><?php



// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$productsubtotal = 0.00;



// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE suppliedproducts.SuppliedProductsID IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['TotalCost'] * (int)$products_in_cart[$product['SuppliedProductsID']];
    }
}
?>


<div class="cart content-wrapper">
    <h1 style="padding-left:20px">Order Details</h1>
    <form action="index.php?page=cart" method="post">

    <?php 
       require ("config.php");
      
    $sql = "INSERT INTO `order` (TransactionID, StaffID, DeliveryStatus, OrderTotal, OrderConfirmed) VALUES (0, 1, 0, 0, 0)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
   
?>
       



                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                
                <?php foreach ($products as $product): ?>

                <tr>

                <?=$product['ProductName']?>                 <?=$product['DeliveryTime']?>



             
              
              
              <?php 
       require ("config.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "g4udatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sqlQuery = $pdo->query('SELECT OrderID FROM `order` ORDER BY OrderID DESC
       LIMIT 1');
       $row2=$sqlQuery->fetch();
       $OrderID = $row2['OrderID'];

       $sqlQuery = $pdo->query('SELECT OrderDate FROM `order` ORDER BY OrderID DESC
       LIMIT 1');
       $row3=$sqlQuery->fetch();
       $OrderDate = $row3['OrderDate'];
       
       $stmt = $conn->prepare( "INSERT INTO `g4udatabase`.`orderedproducts`
    (`OrderID`,
    `QuantityOrdered`,
    `Authorised`,
    `ProductCode`,
    `TotalCost`, `DeliveryDate`)
    VALUES
    (
    :OrderID,
    :QuantityOrdered,
    0,
    :ProductCode,
    :TotalCost, :DeliveryDate);");
            $stmt-> bindParam(':OrderID', $OrderID);

        $stmt-> bindParam(':ProductCode', $ProductCode);
        $stmt-> bindParam(':QuantityOrdered', $QuantityOrdered);
        $stmt-> bindParam(':TotalCost', $TotalCost);
        $stmt-> bindParam(':DeliveryDate', $DeliveryDate);
 

        $ProductCode = $product['ProductCode'];
        $DeliveryTime = $product['DeliveryTime'];


$QuantityOrdered = $products_in_cart[$product['SuppliedProductsID']];
$TotalCost = ($product['TotalCost'] * $products_in_cart[$product['SuppliedProductsID']]);
$DeliveryDate = date('Y-m-d', strtotime($OrderDate. " + {$DeliveryTime} days"));



    $stmt->execute();
}
catch(PDOException $e)
{
echo "Error: " . $e->getMessage();
}
$conn = null;


?>

<?php 
       require ("config.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "g4udatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sqlQuery = $pdo->query('SELECT OrderID FROM `order` ORDER BY OrderID DESC
       LIMIT 1');
       $row2=$sqlQuery->fetch();
       $OrderID = $row2['OrderID'];

       $sqlQuery = $pdo->query('SELECT OrderDate FROM `order` ORDER BY OrderID DESC
       LIMIT 1');
       $row3=$sqlQuery->fetch();
       $OrderDate = $row3['OrderDate'];
       
       $stmt = $conn->prepare( "UPDATE `order` SET OrderTotal = :OrderTotal WHERE OrderID = :OrderID ");
       $stmt-> bindParam(':OrderID', $OrderID);

            $stmt-> bindParam(':OrderTotal', $OrderTotal);
 

        $OrderTotal = $subtotal;

       

    $stmt->execute();

    $stmt = $conn->prepare( "UPDATE `order` SET StaffID = :StaffID WHERE OrderID = :OrderID ");
    $stmt-> bindParam(':OrderID', $OrderID);
    $stmt-> bindParam(':StaffID', $StaffID);
    $StaffID = $_SESSION["staffid"];



$stmt->execute();


   

}
catch(PDOException $e)
{
echo "Error: " . $e->getMessage();
}
$conn = null;


require ("config.php");

$sql = "INSERT INTO `suppliedorder` (OrderID, SupplierID, ProductCode, Delivered, Checked, Returned) VALUES (:OrderID, :SupplierID, :ProductCode, 0, 0, 0)";
$stmt= $pdo->prepare($sql);
$stmt-> bindParam(':ProductCode', $ProductCode);

$stmt-> bindParam(':OrderID', $OrderID);
$stmt-> bindParam(':SupplierID', $SupplierID);
 
$ProductCode = $product['ProductCode'];
$SupplierID = $product['SupplierID'];
$stmt->execute();


header("refresh:5;url=../Login/homepage.php");
unset($_SESSION['cart']);
?>



                <?php endforeach; ?>
                
                <tr>
                <div class="buttons">

        </div><td></td> <td ></td > <td ></td > 					

                        <td ALIGN="center" >                         <div class="subtotal">
            <span class="text"  >Subtotal</span>
            <span class="price" >&pound;<?php echo number_format($subtotal,2); ?></span>
         <br>
         <?PHP
         echo "ORDER HAS BEEN COMPLETED";

      
         ?>
        
						
					</tr>
                <?php endif; ?>

        <tr>
           
                </tr>
 
     
    </form>
<BR>
    

    <script>
    
    </script>
</div>


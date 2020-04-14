<?php
function load_supplier()
{
  $result='';
  require 'config.php';
  $ProductCode=$_GET['ProductCode'];

  $sqlMake=$pdo->prepare('SELECT * FROM suppliedproducts  WHERE ProductCode = :ProductCode');
  $sqlMake->execute(['ProductCode' => $ProductCode]);

  $result=$sqlMake-> fetchAll();
  return $result;
}
?>

<form action="SupplierInformation.php" method="post"> 
<?php session_start(); 
if (isset($_POST['SupplierName'])) {
  $_SESSION['SupplierName'] = $_POST['SupplierName'];
}
$SupplierName = isset($_SESSION['SupplierName']) ? $_SESSION['SupplierName'] : "";


?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Toys Product Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="website.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <body style="background-color:#a6b2c1">

  <div class="container">
    <div class="row">
        <div class="col-lg">
<img src="g4uimageprototype.png" alt="G4ULogo"  id="g4ulogo"></img>
</div>

<div class="col-lg">
    
    <div class="topnav" >  
    <div class="search-box" style="align:left; width:200px ">
        <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
</div>


       
     
           
        </div>
</div>
        <div class ="col-lg">
            <button id="basket-button" class="btn btn-warning">Basket</button>	
            <button id="logout-button"    class="btn btn-danger"><a href="logout.php" style="color:white; height:150px;">Log Out!</a></button>	
      
        </div>
    </div>
  </div>

  <?php
  
  require ("config.php");

$ProductCode=$_GET['ProductCode'];
$sqlQuery = $pdo->prepare('SELECT * FROM product WHERE ProductCode = :ProductCode');
$sqlQuery->execute(['ProductCode' => $ProductCode]);

  while($row = $sqlQuery->fetch())
  {
      ?>

<div class="container">
  <div class="row">
    <div class="col">
    
  <div class="card" style="width: 20rem;" >
  <A href='<?php echo "productInformation.php?ProductCode=".$row['ProductCode'].""; ?>'/>  

      <h4 class="card-title"><?php echo $row['ProductName']; ?></a></h4>
 <?php echo" <img class=center class =ProductImage src='pictures/".$row['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$row['ProductCode']."'" ?>

  <div class="card-body">
  <?php
	echo "<align = center>Product Code: ".$row['ProductCode']."<br>";

	echo "<align = center>Product Name: ".$row['ProductName']."<br>";

	echo "<align = center>Current Stock Level: ".$row['CurrentStockLevel']."<br>";


  echo "<align = center>Low Stock Level: ".$row['LowStockLevel']."<br>";
  ?>
      </div>
  
    </div>

  <?php } ?>
      

    <div class="col-sm">
        <form class="form-inline">
            <div class="form-group mb-2">
              <label for="quantityNeeded" class="sr-only">Email</label>
              <input type="text" readonly class="form-control-plaintext" id="quantityNeeded" value="Quantity X">        
              <input type="number" value="1" min="1" class="form-control">
              <button type="submit" class="btn btn-primary mb-2">Add To</button>
            </div>         
          </form>
    </div>

    <div class="col">
      <div class="card" style="width: 20rem;">
      
      <div class="card-body">
    
      <h5 class="card-title">List of Suppliers to choose from</h5>
      
      <p class="card-text"> 
      
      </div>
      </div>
       <?php
require ("config.php");

$ProductCode=$_GET['ProductCode'];
$sqlQuery = $pdo->prepare('SELECT * FROM suppliedproducts WHERE ProductCode = :ProductCode ');
$sqlQuery->execute(['ProductCode' => $ProductCode]);



while($row = $sqlQuery->fetch())

{
 



    ?>
    <div class="carinfo">  



<select class="forms" name ="SupplierName" style="width:200px" id="SupplierName" searchable="Search here">
<option value="" selected="true" disabled="disabled"> Select Supplier </Option>
 
 <?php 
require ("config.php");
	 $result=load_supplier();
            foreach ($result as $SupplierName): ?>
       <?php echo ' <option value="'. $SupplierName["SupplierName"].'">'. $SupplierName["SupplierName"].'</option>'; ?>
    <?php endforeach; ?>
</select>
<button>Submit</Button>


      <?php



echo"<div class=card style=width: 20rem;>";
echo "<div class=card-body>";
echo "<align = center>Supplier Name: ".$row['SupplierName']."<br>";
echo "<align = center>Delivery Time: ".$row['DeliveryTime']."<br>";
echo "<align = center>Total Cost: ".$row['TotalCost']."<br>";

echo " <div class=btn btn-primary onclick=location.href='basket.php?SuppliedProductsID=".$row['SuppliedProductsID']."'>Buy the product</div>";

echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";


	echo"";


echo "<TR>";
  }

?>  </div>
</div>
</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>


<?php 
// Sedot Code
//mulai session 


    //Jika user belum login maka buat sebuah session yang isinya adalah url yang lagi dibukanya, 
    $_SESSION['redirectme'] = $_SERVER['REQUEST_URI'];
    //Arahkan kehalaman login.php



?>
 





<br>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search_bar").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

</body>
</html>

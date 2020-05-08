

<?php
    if(!isset($_SESSION['auth'])) {
        echo"You need to login";
        header("Location:../Login/Homepage.php") ;
    }
    if($_SESSION["role"]==1){
        $staffid = $_SESSION['staffid'];


        header('gadgetshome.php');
    } else if($_SESSION["role"]==3){
        $staffid = $_SESSION['staffid'];
        header('gadgetshome.php');
    } else  {
        session_destroy();
        header("Location:../Login/Homepage.php") ;
    }
?>

<?php

$stmt = $pdo->prepare('SELECT *  FROM suppliedproducts  JOIN product on suppliedproducts.ProductCode = product.ProductCode WHERE CategoryID = 1  group by product.ProductCode ');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gadgets Product Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="stylesheet" href="../website.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../Back.png" onclick="goBack()" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../g4uimageprototype.png" onclick="window.location.href = 'index.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../Basket.png" id="basket" alt="basket" onclick="window.location.href = 'index.php?page=cart'"></img>
        <img src="../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../logout.php'" ></img>
      
    </div>


<div class="recentlyadded content-wrapper">

    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
            <div class="column">
    <div class="card" >
    <a href="index.php?page=product&ProductCode=<?=$product['ProductCode']?>" class="product">
        <?php echo" <img class=center id=ProductImage src='pictures/".$product['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$product['ProductCode']."'" ?>
        <div class="card-body">
            <h4 class="card-title"><?php echo $product['ProductName']; ?></a></h4>
        </div>
    </div>
</div>
        <?php endforeach; ?>
    </div>
</div>

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
<script>
function goBack() {
  window.history.back();
}
</script>

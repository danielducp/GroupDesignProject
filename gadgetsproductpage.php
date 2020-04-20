<?php
    session_start() ;
    if(!isset($_SESSION['auth'])) {
        echo"You need to login";
        header("Location:homepage.php") ;
    }
    if($_SESSION["role"]==1){
        header('gadgetsproductpage.php');
    } else if($_SESSION["role"]==3){
        header('gadgetsproductpage.php');
    } else  {
        session_destroy();
        header("Location:homepage.php") ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gadgets Product Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="website.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#000000">
    <div style="background-color:#a6b2c1" class="topnav" align="center">
        <button id="back-button" class="btn btn-danger">Back</button>
        <img src="g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
        <button id="search-button" class="btn btn-success">Search</button>
        <img src="basket.png" id="basket"></img>
        <button id="logout-button" class="btn btn-danger">Log Out</button>
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
</body>
</html>

<?php
    require 'config.php';     
    $sqlQuery = $pdo->query('SELECT * FROM product WHERE CategoryID = 1');      
    while($row = $sqlQuery->fetch())
    {
?>
<div class="column">
    <div class="card" >
        <A href='<?php echo "productInformation.php?ProductCode=".$row['ProductCode'].""; ?>'/>
        <?php echo" <img class=center id=ProductImage src='pictures/".$row['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$row['ProductCode']."'" ?>
        <div class="card-body">
            <h4 class="card-title"><?php echo $row['ProductName']; ?></a></h4>
        </div>
    </div>
</div>
<?php } ?>
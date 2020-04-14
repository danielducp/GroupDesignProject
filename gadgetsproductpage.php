<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
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
<head>

  <!DOCTYPE html>
<html lang="en">
<head>
<title>Gadgets Product Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="website.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <body style="background-color:#a6b2c1">

</head>
<body>
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
</head>
<body>

</body>
</div>

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


 <?php echo" <img class=center class =ProductImage src='pictures/".$row['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$row['ProductCode']."'" ?>

  <div class="card-body">
      <h4 class="card-title"><?php echo $row['ProductName']; ?></a></h4>
      </div>
  
    </div>

  </div>  </div>

  <?php } ?>


 
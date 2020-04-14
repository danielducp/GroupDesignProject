<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "g4udatabase");

if(isset($_POST["orderconfirmation"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		if(!in_array($_GET["SuppliedProductsID"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
                'item_id'			=>	$_GET["SuppliedProductsID"],
                'item_suppliername'			=>	$_POST["SupplierName"],
                'item_supplierdelivery'			=>	$_POST["DeliveryTime"],
                'item_name'			=>	$_POST["ProductName"],
                'item_code'			=>	$_POST["ProductCode"],

				'item_price'		=>	$_POST["TotalCost"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		
	}
	else
	{
		$item_array = array(
            'item_id'			=>	$_GET["SuppliedProductsID"],
            'item_suppliername'			=>	$_POST["SupplierName"],
            'item_supplierdelivery'			=>	$_POST["DeliveryTime"],
            'item_name'			=>	$_POST["ProductName"],
            'item_code'			=>	$_POST["ProductCode"],
			'item_price'		=>	$_POST["TotalCost"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "confirmorder")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
                
                unset($_SESSION["shopping_cart"][$keys]);
                

$StaffID=$_POST['StaffID'];
$OrderDate=$_POST['OrderDate'];


    require 'config.php';
    $sqlQuery = $pdo->query('SELECT OrderID FROM order ORDER BY OrderID DESC LIMIT 1');
    $row=$sqlQuery->fetch();
    $carIndex = $row['OrderID']+1;
$sql = "INSERT INTO order (OrderID, StaffID, OrderDate) VALUES (?,?, = . date(d.m.y) .)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$OrderID, $StaffID, $OrderDate]);


				echo '<script>alert("Order Confirmed")</script>';
		
		}
	}
}


?>
<html>
<head>
    <link href="style.css" 
          rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
</head>
<body style="background-color:#a6b2c1">
    <div class="topnav" ALIGN="center">  
        <button id="logout-button" class="btn btn-danger">Back</button> 
        <img src="g4uimageprototype.png" alt="G4ULogo"  width="12.5%"></img>
        <input type="text" placeholder="Search.." style="margin-top: 100px;">  
             
        <button id="search-button" class="btn btn-success">Search!</button>        
        <button id="basket-button" class="btn btn-warning">Basket</button>            
        <button id="logout-button" class="btn btn-danger">Log Out!</button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4" style="background-color:white;">
                <p>List of items go here</p>
            </div>
            <div class="col-sm-1" style="background-color:white;">
                <button id="reduce-button" class="btn btn-success">-</button>
            </div>
            <div class="col-sm-1" style="background-color:white;">
                <p>0</p>
            </div>
            <div class="col-sm-1" style="background-color:white;">
                <button id="increase-button" class="btn btn-success">+</button>
            </div>
            <div class="col-sm-2" style="background-color:white;">
                <button id="remove-button" class="btn btn-success">Remove</button>         
            </div>
            <div class="col-sm-2" style="background-color:white;">  
                <p>Price</p>          
            </div>
            <div class="col-sm-1">
                <button id="confirm-button" class="btn btn-success">Confirm Order</button>      
            </div>
        </div>
      </div>
    </div>
</body>
</html>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
					
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
                    <td><?php echo $values["item_quantity"]; ?></td>

						<td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_suppliername"]; ?></td>
                        <td><?php echo $values["item_supplierdelivery"]; ?> days</td>

                        <td><?php echo $values["item_quantity"]; ?></td>

						<td>£ <?php echo $values["item_price"]; ?></td>
                        <td>£ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                        

					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Order Total</td>
						<td align="right">£ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>

					
					<?php
					}
					?>
						

                <td><a href="orderconfirmation.php?action=confirmorder"><span class="text-danger">                <button id="remove-button" class="btn btn-success">Remove</button>         
</span></a></td>
		</div>
	</div>
	<br />
	</body>
</html>

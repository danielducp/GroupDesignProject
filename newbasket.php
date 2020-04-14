<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "g4udatabase");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["SuppliedProductsID"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["SuppliedProductsID"],
				'item_supplier'			=>	$_POST["SupplierName"],
				'item_name'			=>	$_POST["ProductName"],
				'item_price'		=>	$_POST["TotalCost"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["SuppliedProductsID"],
			'item_supplier'			=>	$_POST["SupplierName"],
			'item_name'			=>	$_POST["ProductName"],
			'item_price'		=>	$_POST["TotalCost"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="newbasket.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<br /><br />
			<?php
				$query = "SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="basketlist.php?action=add&SuppliedProductsID=<?php echo $row["SuppliedProductsID"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img style="width:300px; height: 300px" src="Pictures/<?php echo $row["ProductImage"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info">Name: <?php echo $row["ProductName"]; ?></h4>
						<h4 class="text-info">Supplier Name: <?php echo $row["SupplierName"]; ?></h4>
						<h4 class="text-info">Delivery Time: <?php echo $row["DeliveryTime"]; ?> days</h4>

						<h4 class="text-danger">£ <?php echo $row["TotalCost"]; ?></h4>

						<input type="number" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="ProductName" value="<?php echo $row["ProductName"]; ?>" />
						<input type="hidden" name="SupplierName" value="<?php echo $row["SupplierName"]; ?>" />
						<input type="hidden" name="DeliveryTime" value="<?php echo $row["DeliveryTime"]; ?>" />

						<input type="hidden" name="TotalCost" value="<?php echo $row["TotalCost"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			
		</div>
	</div>
	<br />
	</body>
</html>

<?php
//If you have use Older PHP Version, Please Uncomment this function for removing error 

/*function array_column($array, $column_name)
{
	$output = array();
	foreach($array as $keys => $values)
	{
		$output[] = $values[$column_name];
	}
	return $output;
}*/
?>
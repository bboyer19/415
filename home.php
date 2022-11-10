<?php 
session_start();

include("connect.php");
include("helper.php");

	$user_data = check_login($con);
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//retreiving orderid and some data
		$orderID = uniqid();
		$buyerID = $user_data['buyerID'];
		$shoesID = $_POST['item-model'];
		$shoesPrice = $_POST['item-price'];
		$image = $_POST['item-img'];
		//this is to change the time zone
		date_default_timezone_set('america/chicago');
		$date = date('Y-m-d H:i:s');
		// echo "order is " . $orderID."\n";
		// echo $buyerID."\n";
		// echo $shoesID."\n";
		// echo $shoesPrice."\n";
		// echo $date;
		//insert this order into the database
		$query = "insert into orders (orderID,buyerID,shoesID,price,date,image)
					values ('$orderID','$buyerID','$shoesID','$shoesPrice','$date','$image')";
		mysqli_query($con,$query);
		header("Location: home.php");
		die;
	}
	// else if($_SERVER['REQUEST_METHOD'] == "GET"){
	// 	header("Location: listOfOrders.php");
	// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<style>
	
	body {
		background-color: lightblue;
	}
	.shoes-img{
		height: 250px;
		width: 300px;
	}
	.navbar-brand{
		float: left;
		margin:0px 0px 0px 0px!important;
		text-align: center;
		width: 100%;
		height:100%;
		background-color: black;
		color:white;
	
	}

	.shoes-container{

	}
</style>
<script>
	function makeAnOrder(orderID, buyerID, shoesID,price){
		let today = new Date().toLocaleDateString()
		
		console.log("order id is " + orderID+"\n" + "buyerID id is " + buyerID + "\n" +  "shoesID id is " + shoesID +"\nprice is " + price + "\n" + "date  is " + today);
		<?php 
		
		?>
	}
</script>
<body>
		<nav style="margin:0px 0px 0px 0px;" class="container-fluid navbar navbar-light bg-light">
				
			<a  class="text-white navbar-brand" href="#">DREW'S KICK SHOP</a>
			<a style="color:white;"	class="text-white nav-link"href="">Sign up</a>
		</nav>
	<h1>Welcome: <?php echo $user_data['name'];?></h1>
	<a class="btn btn-dark" href="log_out.php">Logout</a>
	<a class="btn btn-dark" href="listOfOrders.php">List Of Orders</a>
	
	
	
	<h4>Current Available Stock:</h4>
	<div class="flex-row d-flex justify-content-around" >
	<?php 
		$result = mysqli_query(
			$con,
			"SELECT * FROM products "
		);
		
		while($row = mysqli_fetch_assoc($result)){?>
				
				<div  class=" d-inline-flex border justify-content-between shoes-container">
					
					<form action="" method="POST">
					
						<h3 name ="item-name"><?= $row['name'] ?></h3>
						<h4 name="item-price">$<?= $row['price'] ?></h4>
						<p name="item-model">Model: <?= $row['shoesID'] ?> </p>
						<input type="hidden" name ="item-price" value ="<?= $row['price'] ?>">
						<input type="hidden" name ="item-model" value ="<?= $row['shoesID'] ?> ">
						<input type="hidden" name ="item-img" value ="<?= $row['image'] ?> ">
						<img class="shoes-img" src="images/<?= $row['image'] ?>">
						<div><button class="btn-secondary btn" type ="submit">Make an Order</button></div>
						<div><a  class="btn-secondary "href="review.php?shoesID=<?= $row["shoesID"] ?>">Reviews and rating on this shoes</a></div>
						
					</form>
						

						
					
				</div>
				
			<?php
		}
	?>
	</div>
	
</body>
</html>
<?php

session_start();
include("connect.php");
include("helper.php");
$user_data = check_login($con);



//processing the post request from users to upload review
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //we need reviewID, shoesID, orderID, buyerID, review
    //don't display orderID
    
    $shoesID = $_POST['shoesID'];
    $orderID = $_POST['orderID'];
    $buyerID = $_POST['buyerID'];
    $review =  $_POST['review'];
    $image = $_POST['image'];
    if(!empty($review)){
        $reviewID = uniqid();
        $query = "insert into review (reviewID,shoesID,orderID,buyerID,review,image) 
                VALUES('$reviewID','$shoesID','$orderID','$buyerID','$review','$image')";
        mysqli_query($con,$query);
        header("Location: listOfOrders.php");
        die;
    }
 }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>Document</title>
</head>
<style>
    body{
        background-color: lightblue;
    }
   .shoes-container{
        margin: 10px;
        padding: 10px;
    }
	.shoes-img{
		height: 250px;
		width: 300px;
	}
    button{
        padding: 10px;
        margin: 10px 10px 10px 0px;
    }
    .navbar-brand{
		float: left;
		margin:0px 0px 0px 0px!important;
		text-align: center;
		width: 100%;
		
		background-color: black;
		color:white;
	
	}
	.nav-link{
		color:white;
	}
	.navbar-brand {float:none;}
  
</style>
<body>
    
    <nav style="margin:0px 0px 0px 0px;" class="container-fluid navbar navbar-light bg-light">
			<a  class=" w-100 h-100 text-white navbar-brand" href="home.php">DREW'S KICK SHOP</a>
			<a style="color:white;"	class="text-white nav-link"href="">Sign up</a>
    </nav>
    <h1>Welcome: <?php echo $user_data['name'];?></h1>
    <div class="d-flex d-inline flex-column">
    <?php 
        $userID = $user_data['buyerID'];
        $query = "select * from orders WHERE buyerID = '$userID';" ;
        
		$result = mysqli_query(
			$con,
            $query
		);
		
		while($row = mysqli_fetch_assoc($result)){?>
				<div  class="border shoes-container">
                    <form action="" method ="POST">
                    <!-- //we need reviewID, shoesID, orderID, buyerID, review -->
                        <img class="shoes-img" src="images/<?= $row['image'] ?>">
                        <p>OrderID: <?= $row['orderID'] ?></p>
                        <p>Model: <?= $row['shoesID'] ?></p>
                        <p>Price: <?= $row['price'] ?></p>
                        <p>Date: <?= $row['date'] ?></p>
                        <input type="hidden" name= 'shoesID' value = '<?= $row['shoesID']?>'>
                        <input type="hidden" name= 'orderID' value = '<?= $row['orderID']?>'>
                        <input type="hidden" name= 'buyerID' value = '<?= $row['buyerID']?>'>
                        <input type="hidden" name= 'image' value = '<?= $row['image']?>'>
                        <h4>Leave a review</h4>
                        <input placeholder="Leave a review here"  name='review' style="height:100px; width: 500px" type="text">
                        <div><button type = "Submit" >Post your reviews</button></div>
                        
                    </form>
                    

						

						
					
				</div>
				
			<?php
		}
	?>
    </div>
    
</body>
</html>
<?php 

    session_start();
    
    include("connect.php");
    include("helper.php");


    
    
    $user_data = check_login($con);
    $shoesID = $_GET['shoesID'];
    
   
    //how do we know which shoes is which
    //using shoesID

   
    


?>
<style>
	.shoes-img{
		height: 250px;
		width: 300px;
	}
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body style = "background-color:lightblue;">
    <nav style="margin:0px 0px 0px 0px;" class="container-fluid navbar navbar-light bg-light">
			<a  class=" w-100 h-100 text-white navbar-brand" href="home.php">DREW'S KICK SHOP</a>
			<a style="color:white;"	class="text-white nav-link"href="">Sign up</a>
    </nav>
    <h1>Reviews on <?= $shoesID ?></h1>
    
    
    <?php 
        $shoesID = trim($shoesID);
        $query = "select * from review where shoesID = '$shoesID' " ; 
        
        //getting the image name
        $imageQuery = "select image from review where shoesID = '$shoesID' limit 1 " ;
        $imageResult = mysqli_query(
            $con,
            $imageQuery
        );
        while ($row = mysqli_fetch_assoc($imageResult)){?>
            <img class="shoes-img" src="images/<?= $row['image'] ?>"> 
        <?php
        }
        
        //loading all the reviews
        $result = mysqli_query(
            $con,
            $query
        );
        
        
       
        while($row = mysqli_fetch_assoc($result)){?>
            <div  class="border review-container">
               
                
                <p>Review ID: <?= $row['reviewID'] ?></p>
                <p>Model: <?= $row['shoesID'] ?></p>
                <p>Order ID : <?= $row['orderID'] ?></p>
                <p>Review: <?= $row['review'] ?></p>
               
                

                    

                    
                
            </div>
            
        <?php
    }
        
		
	
	?>
    
</body>
</html>
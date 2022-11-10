<?php 

session_start();

	include("connect.php");
	include("helper.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from usertable where username = '$user_name' limit 1;";
			$result = mysqli_query($con, $query);
			
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['buyerID'] = $user_data['buyerID'];
						header("Location: home.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
			echo "$user_name";
			echo "$password";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>

<style>
	body{
		padding: 0;
		margin: 0 0 0 0;
		background-color: white;
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
	.user-input{
		background-color: #4592AF;
		border-style: hidden;
		height: 40px;
		width: 200px;
	}
	.navbar{
		top:0px;
		
	}
</style>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body style="background-color: silver">


		<nav style="margin:0px 0px 0px 0px;" class="container-fluid navbar navbar-light bg-light">
			<a  class=" w-100 h-100 text-white navbar-brand" href="#">DREW'S KICK SHOP</a>
			<a style="color:white;"	class="text-white nav-link"href="">Sign up</a>
		</nav>
		
		<h3 >Login</h3s>
		<form method="post">
			
			<div class="form-outline mb-4">
				
				<input placeholder="Enter your username" class="user-input form-control" id="username" type="text" name="user_name">
				
			</div>
			<div class="form-outline mb-4" >
				<input placeholder="Enter your password" class="user-input form-control" id="text" type="password" name="password">

			</div>
			<input class="btn btn-primary btn-block mb-4" id="button" type="submit" value="Login">

			<a href="sign_up.php">Click to Signup</a>
		</form>
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
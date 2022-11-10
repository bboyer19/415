<?php 
session_start();

	include("connect.php");
	include("helper.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_fullName =  $_POST['fullname'];
		$user_phoneNumber = $_POST['user_phoneNumber'];
		$user_email = $_POST['user_email'];
 		$user_name = $_POST['user_name'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		if(!empty($user_fullName) && !empty($user_phoneNumber)&& !empty($user_email) &&  !empty($user_name)  && !empty($password1) && !is_numeric($user_name) && strcmp($password1, $password2) == 0)
		{

			//save to database
			$user_id = uniqid();
			$query = "insert into usertable (buyerID,name,phoneNumber,email,username,password) 
			values ('$user_id','$user_fullName','$user_phoneNumber','$user_email','$user_name','$password1')";
			
			echo"$user_id";
			echo"$user_phoneNumber";


			mysqli_query($con, $query);

			// header("Location: index.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<style>
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
			<a  class=" w-100 h-100 text-white navbar-brand" href="home.php">D R E W</a>
			<a style="color:white;"	class="text-white nav-link"href="">Sign up</a>
    </nav>

	<h1>Sign up</h1>
	<div class="form-outline container" >
		
		<form method="post">
			
			<label> Enter your name </label>
			<input type="text" id= "userFullName" name ="fullname"><br><br>
			<label> Enter your Phone Number </label>
			<input id="phoneNumber" type="number" name="user_phoneNumber"><br><br>
			<label> Enter your email </label>
			<input id="email" type="email" name="user_email"><br><br>
			<label> Enter your username </label>
			<input type="text" id= "username" name ="user_name"><br><br>
			<label> Enter your password </label>
			<input type="password" id= "password1" name ="password1"><br><br>
			<label> Re-enter your password </label>
			<input type="password" id= "password2" name ="password2"><br><br>
			<input id="button" type="submit" value="Signup"><br><br>

			<a href="index.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>
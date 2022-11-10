<?php 
session_start();

include("connect.php");
include("helper.php");

	$user_data = check_login($con);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
Hello <?php echo $user_data['name']; 
				echo $user_data['buyerID']; 	?>
</body>
</html>
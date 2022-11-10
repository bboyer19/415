<?php

session_start();

if(isset($_SESSION['buyerId']))
{
	unset($_SESSION['buyerID']);

}

header("Location: index.php");
die;
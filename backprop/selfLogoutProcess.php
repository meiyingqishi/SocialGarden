<?php

	session_start();
	
	$_SESSION['nickname'] = "";
	$_SESSION['user_id'] = "";
	
	header("Location: ../garden.php");
	exit();
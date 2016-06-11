<?php

	session_start();
	
	if ($_SESSION['nickname'] == '') {
		header("Location: ../garden.php");
		exit();
	}
	
	header("Location: ../self.php");
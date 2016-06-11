<?php
	session_start();
	require_once "phptextClass.php";	
	
	$phptextObj = new phptextClass();
	$phptextObj->phpcaptcha('#162453','#fff',120,32,10,10);	
 ?>
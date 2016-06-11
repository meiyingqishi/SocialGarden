<?php session_start();
	require_once 'SqlHelper.class.php';
	
	$sqlHelper = new SQLHelper();
	
	$sql = "select password, nickname, id from tb_user where username='{$_POST['username']}'";
	
	$arrRes = $sqlHelper->excute_dql2($sql);
	
	if (md5($_POST['password']) == $arrRes[0]['password']) {
		$_SESSION["isLogin"] = "yes";
		$_SESSION["user_id"] = $arrRes[0]['id'];
		$_SESSION["nickname"] = $arrRes[0]['nickname'];
		echo $arrRes[0]['nickname'];
		exit();
	}
	
	$_SESSION["isLogin"] = "no";
	echo '0';
	exit();
?>
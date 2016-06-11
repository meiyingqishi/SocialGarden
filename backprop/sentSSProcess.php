<?php 
	/**
	 * 处理用户发送说说
	 */

	session_start();
	
	require_once 'SqlHelper.class.php';
	
	if ($_SESSION["nickname"] == '')	 {
		echo 3;
		exit();
	}
	
	$userid = $_SESSION["user_id"];		// 保存发表说说的人的id到数据库
	$msg = trim($_POST["msg"]);		// 发表的内容
	
	$msg = strip_tags($msg);	// 剥去字符串中的 HTML 标签
	
	if (strlen(trim($msg)) < 1) {
		echo 0;	// 发表失败
		exit();
	}
	
	$sqlSentSS = "insert into tb_content (user_id, msg, sent_time) values ('$userid', '$msg', now());";	// 插入说说
	
	$sqlHelper = new SqlHelper();
	$res = $sqlHelper->excute_dml($sqlSentSS);
	if ($res == 1) {
		$_SESSION["msg"] = $msg;
		$ssTemplate = '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">'. $_SESSION["nickname"] .'</h3></div><div class="panel-body">'. $_SESSION["msg"] .'</div><div class="panel-footer"><input class="btn btn-success" type="button" id="btnZan" value="点  赞">       <input class="btn btn-success" type="button" id="btnRefresh" value="评 论"></div></div>';
		echo $ssTemplate;	// 发表成功
	}
	else {
		echo 0; // 发表失败
		exit();
	}
?>
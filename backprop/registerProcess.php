<?php session_start();
	/**
	 * 用户注册处理
	 */

	require_once 'SqlHelper.class.php';

	/**
	 * 判断是否包含字符
	 * @param unknown $str
	 * @return boolean
	 */
	function isAllEnStr($str) {
		$strPattern = "#[\x7f-\xff]+#";
		if (preg_match($strPattern, $str))
			return false;
		return true;
	}
	
	// 获取用户注册信息
	$uid = trim($_POST["username"]);	// 账号
	$pwd = trim($_POST["password"]);	// 密码
	$email = trim($_POST["email"]);		// 邮箱
	$checkcode = trim($_POST["checkcode"]);		// 验证码
	$nickname = trim($_POST["nickname"]);		// 昵称
	$savePwdAnswer = trim($_POST["savePwdAnswer"]);			// 密保
	
	// 验证账号、邮箱、验证码是否包含中文字符
	if (!isAllEnStr($uid) || !isAllEnStr($email) || !isAllEnStr($checkcode)) {
		echo 1;	// 包含中文
		exit();
	}
	
	// 验证密码是否低于8位
	if (strlen($pwd) < 8) {
		echo 2; // 密码长度小于8位
		exit();
	}
	
	// 验证验证码是否正确
	if ($checkcode != $_SESSION["captcha_code"]) {
		echo 4;	// 验证码错误
		exit();
	}
	
	// 查看账号是否已存在
	$sqlHelper = new SqlHelper();
	$sqlAccount = "select count(id) from tb_user where username='$uid'";
	$res = $sqlHelper->excute_dql($sqlAccount);
	$row = $res->fetch_row();
	$res->free();
	if ($row[0] > 0) {
		echo 3;	// 账户已存在
		exit();
	}
	
	// 注册用户
	$sqlInsert = "insert into tb_user (username, password, nickname, email, save_pwd_answer) values ('$uid', md5('$pwd'), '$nickname', '$email', '$savePwdAnswer');";
	$result = $sqlHelper->excute_dml($sqlInsert);
	if ($result == 1) {
		$sqlSelId = "select id from tb_user where username='$uid';";	// 从数据库查询用户对应的id
		$res = $sqlHelper->excute_dql($sqlSelId);
		$row = $res->fetch_row();
		$res->free();
		$_SESSION["user_id"] = $row[0];
		$_SESSION["nickname"] = $nickname;
		$_SESSION["isLogin"] = "yes";
		echo 5; // 注册成功
		exit();
	}

?>
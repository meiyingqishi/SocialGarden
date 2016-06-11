<?php

/*
 * 点赞处理
 */

require_once 'SqlHelper.class.php';
session_start();

if (@$_SESSION['nickname'] == '') {
	echo "<script>alert('请登录再赞！');location='../garden.php';</script>";
	exit();
}

$sqlHelper = new SqlHelper();
$sqlSelect = "select id from tb_zan where content_id={$_GET['tag']} and user_id={$_SESSION['user_id']}";

$res = $sqlHelper->excute_dql($sqlSelect);
$count = mysqli_fetch_assoc($res);
mysqli_free_result($res);

if (empty($count)) {
	$sqlInsert = "insert into tb_zan (user_id, content_id) values ({$_SESSION['user_id']}, {$_GET['tag']});";
	$sqlHelper->excute_dml($sqlInsert);
} else {
	$sqlDelete = "delete from tb_zan where content_id={$_GET['tag']} and user_id={$_SESSION['user_id']}";
	$sqlHelper->excute_dml($sqlDelete);
}

header("Location: ../garden.php");
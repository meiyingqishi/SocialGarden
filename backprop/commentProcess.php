<?php

/*
 * 用户评论记录
 */

require_once 'SqlHelper.class.php';

session_start();

if (empty($_POST['comment'])) {
	echo '1';
	exit();
}

if ($_SESSION['nickname'] == '') {
	echo '2';
	exit();
}

$comment = strip_tags($_POST['comment']);	// 剥去字符串中的 HTML 标签

$sqlInsertComment = "insert into tb_comment (clickcomment_user_id, commented_user_id, content_id, comment, comment_datetime) values ({$_SESSION['user_id']}, {$_POST['user_id']}, {$_POST['content_id']}, '$comment', now())";

$sqlHelper = new SqlHelper();
$sqlHelper->excute_dml($sqlInsertComment);
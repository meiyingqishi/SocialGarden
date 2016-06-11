<?php

/*
 * 处理garden.php的退出
 */

session_start();

$_SESSION['nickname'] = '';
$_SESSION['user_id'] = '';

header("Location: ../garden.php");
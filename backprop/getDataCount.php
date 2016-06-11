<?php

/*
 * 获取内容数据总数
 */

require_once 'SqlHelper.class.php';

session_start();

$rowCountSql = "select count(id) counts from tb_content";

$sqlHelper = new SqlHelper();

$resArr = $sqlHelper->excute_dql2($rowCountSql);

echo $resArr[0]['counts'];
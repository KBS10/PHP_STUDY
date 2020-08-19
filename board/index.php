<?php
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////
session_start();
require_once ("Conf/board_conf.php");
require_once ("util/board_util.php");
require_once ("util/pagination.php");
require_once ("Model/board_model.php");

$board_id = isset($_GET['board_id']) ? $_GET['board_id'] : NULL;
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$titles = [
    'write'     => '게시물 작성',
    'list'      => '게시물 목록',
    'view'      => '게시물 조회',
    'modify'    => '게시물 수정',
    'delete'    => '게시물 삭제'
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $titles[$page]?></title>
    <link rel="stylesheet" href="Style.css" type="text/css">
</head>
<body>
    <?php include_once ("./{$page}.php"); ?>
</body>
</html>
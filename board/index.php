<?php
$page = isset($_GET['page']) ? $_GET['page'] : NULL;
$id = isset($_GET['id']) ? $_GET['id'] : NULL;

$titles = [
    'write'     => '게시물 작성',
    'list'      => '게시물 목록',
    'view'      => '게시물 조회',
    'modify'    => '게시물 수정',
    'delete'    => '게시물 삭제',
]
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $titles{$page} ?></title>
</head>
<body>
    <?php include_once ("./{$page}.php"); ?>
</body>
</html>
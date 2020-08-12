<?php
require_once('DB.php');
require_once('my_util.php');

////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////
if(isset($_GET['board_id']) && is_numeric($_GET['board_id'])){
    $writeNumber = $_GET['board_id'];
}else{
    prtErrorMsg("해당된 게시판이 없습니다.");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <div>글 삭제 : <?php echo "글 번호".$writeNumber?></div>
        <form method="post" action="<?php echo Board_Info::FILENAME_DELETE_PROCESS."?board_id=$writeNumber";?>">
            <div> 비밀번호 : </div>
            <input type="text" name="user_passwd">
            <input type="submit" onclick="location.href='./delete_process.php?board_id=<?PHP echo $writeNumber?>" value="글삭제">
        </form>
</body>
</html>

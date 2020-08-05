<?php
session_start();
require_once('my_util.php');
require_once('DB.php');
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

if(isset($_SESSION['id']) == false && isset($_SESSION['password']) == false){
    prtErrorMsg("잘못된 접근입니다.");
}

// DBMS 연결
$db_conn = makeDBConnection();
$sql = "select board_id, title, contents, user_name, hits, reg_date from mybulletin where board_id = $writeNumber";
// DBMS 연결 실패 여부 검사
if(!$result = $db_conn ->query($sql)){
    echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
    exit(-1); // 시스템 종료
}
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        caption{
            background-color: #cccccc;
            color: white;
        }
        .view_table{
            border: 1px solid #444444;
            margin-top: 30px;
        }
        .view_title{
            height: 50px;
            text-align: center;
            background-color: #444444;
            color: white;
            width: 1000px;
        }
        .view_content{
            padding-top: 20px;
            border-top: 1px solid #444444;
            width: 800px;
            height: 500px;
        }
        #contents{
            display: block;
            margin: 0 auto;
            width: 800px;
            height: 500px;
        }
        .view_btn{
            width: 700px;
            height: 200px;
            text-align: center;
            margin: auto;
            margin-top: 50px;
        }
        #modify_btn,
        .view_btn_list{
            height: 50px;
            width: 100px;
            font-size: 20px;
            text-align: center;
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
        }

    </style>
</head>
<body>
<form method="post" action="<?php echo Board_Info::FILENAME_MODIFY_PROCESS."?board_id=".$writeNumber; ?>">
<table class="view_table" align="center">
    <caption>글 번호 : <?php echo $row['board_id']?></caption>
    <tr><td colspan="2" class="view_title">
        <input type="text" name="title" style="width: 500px" value="<?php echo $row['title']?>"></td>
        <input type="text" name="user_name" hidden style="width: 500px" value=<?php echo $_SESSION['id']?> >
        <input type="text" name="user_passwd" hidden style="width: 500px" value=<?PHP echo $_SESSION['password']?> >
    <tr>
        <td colspan="2" class="view_content" valign="top">
        <input type="text" id="contents" name="contents"  value="<?php echo $row['contents'] ?>">
        </td>
    </tr>
</table>
    <div class="view_btn">
    <input id="modify_btn" type="submit" onclick="location.href='./modify_process.php?board_id=<?PHP echo $writeNumber?>" value="글수정">
</form>
    <button class="view_btn_list"   onClick="location.href='./list.php'">글목록</button>
</div>

</body>
</html>
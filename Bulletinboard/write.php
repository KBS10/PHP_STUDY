<?php
session_start();
require_once('my_util.php');

if(isset($_SESSION['id']) == false && isset($_SESSION['password']) == false){
prtErrorMsg("잘못된 접근입니다.");
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
<style>
    table.table2{
        border-collapse: separate;
        border-spacing: 1px;
        text-align: left;
        line-height: 1.5;
        border-top: 1px solid #ccc;
        margin : 20px 10px;
    }
    table.table2 tr {
        width: 50px;
        padding: 10px;
        font-weight: bold;
        vertical-align: top;
        border-bottom: 1px solid #ccc;
    }
    table.table2 td {
        width: 100px;
        padding: 10px;
        vertical-align: top;
        border-bottom: 1px solid #ccc;
    }
    input{
        align-content: center;
        margin: 0 auto;
    }
</style>

<body>
<form method="post" action=<?php echo Board_Info::FILENAME_WRITE_PROCESS; ?>>
    <table  style="padding-top:50px" align = center width=700 border=0 cellpadding=2 >
        <tr>
            <td height=20 align= center bgcolor=#ccc><font color=white> 글쓰기</font></td>
        </tr>
        <tr>
            <td bgcolor=white>
                <table class = "table2">
                    <tr><td>제목</td><td><input type="text" name="title" style="width: 300px" required></td></tr>
                    <tr><td>작성자</td><td><?PHP echo $_SESSION['id']?></td></tr>
                    <input type="text" name="user_name" value=<?PHP echo $_SESSION['id']?> hidden>
                    <input type="text" name="user_passwd" value=<?PHP echo $_SESSION['password']?> hidden>
                    <tr><td colspan = "2"><textarea name="content" rows="20" cols="92" required></textarea></td></tr>
                </table>
                <input type="submit" value="작성" name="write" style="width: 700px">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
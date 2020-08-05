<?PHP
require_once('DB.php');
require_once('my_util.php');
session_start();
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
// DBMS 연결
$db_conn = makeDBConnection();
$sql = "select board_id, title, contents, user_name, hits, reg_date from mybulletin where board_id = $writeNumber";
if(Board_Info::IS_HIT_INCREASE){
    $hit = "update mybulletin set hits = hits + 1 where board_id= $writeNumber";
    $db_conn -> query($hit);
}
// DB에 저장된 열에대해 쿼리를 보냄
if(!$result = $db_conn ->query($sql)){
    echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
    exit(-1); // 시스템 종료 : PHP 엔진 번역 작업 중지
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
        .view_table,{
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
        .view_username1,
        .view_reg_date1,
        .view_hits1{
            text-align: center;
            background: #eeeeee;
            width: 30px;
        }
        .view_username2,
        .view_reg_date2,
        .view_hits2{
            background-color: white;
            width: 60px;
        }
        .view_content{
            padding-top: 20px;
            border-top: 1px solid #444444;
            height: 500px;
        }
        .view_btn{
            width: 700px;
            height: 200px;
            text-align: center;
            margin: auto;
            margin-top: 50px;
        }
        .view_btn_list,
        .view_btn_modify,
        .view_btn_delete{
            height: 50px;
            width: 100px;
            font-size: 20px;
            text-align: center;
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
        }
        .view_comment,
        .view__write_comment{
            margin: 0 auto;
            width: 1000px;
        }
        .view_input_comment_write{
            display : block;
            margin: 0 auto;
        }
        #view_comment_header{
            background-color: #cccccc;
            color: white;
        }
        #view_comment_button{
            display : block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
        <table class="view_table" align="center">
            <caption>글 번호 : <?php echo $row['board_id']?></caption>
            <tr><td colspan="2" class="view_title"><?php echo $row['title']?></td></tr>
            <tr><td class="view_username1">작성자</td>
                <td class="view_username2"><?php echo $row['user_name']?></td></tr>
            <tr><td class="view_reg_date1">작성시간</td>
                <td class="view_reg_date2"><?php echo date_format(date_create($row['reg_date']),
                        'Y년 m월 d일 h시 i분 s초');?></td></tr>
            <tr><td class="view_hits1">조회수</td>
                <td class="view_hits2"><?php echo $row['hits']?></td></tr>
            <tr><td colspan="2" class="view_content" valign="top">
                    <?php echo $row['contents'] ?></td></tr>
        </table>
        <div class="view_btn">
            <button class="view_btn_list"   onClick="location.href='./list.php'">글목록</button>
            <?php if(isset($_SESSION['id']) && $_SESSION['id'] == $row['user_name']): ?>
                <button class="view_btn_delete" onClick="location.href='./delete.php?board_id=<?PHP echo $writeNumber?>'">글삭제</button>
                <button class="view_btn_modify" onClick="location.href='./modify.php?board_id=<?PHP echo $writeNumber?>'">글수정</button>
            <?PHP endif; ?>
        </div>

        <?php if(isset($_SESSION['id'])): ?>
        <div class="view__write_comment">
            <form method="post" action=<?php echo Board_Info::FILENAME_COMMENT_WRITE_PROCESS."?board_id=".$writeNumber; ?>>
                <table>
                    <caption>댓글</caption>
                    <tr><th style="width: 200px">코멘트</th><td><input type="text" name="comment" style="width: 800px"></td></tr>
                    <input type="text" name="comment_writer" value=<?PHP echo $_SESSION['id'];?> hidden style="width: 800px"></td></tr>
                    <input type="text" name="comment_password" value=<?PHP echo $_SESSION['password'];?> hidden style="width: 800px"></td></tr>
                </table>
                <input class="view_input_comment_write" type="submit" name="comment_write" value="댓글 쓰기">
            </form>
        </div>
        <?PHP endif; ?>
        <br><br>
            <table class="view_comment">
                <tr id="view_comment_header"><th>작성자</th>
                    <th>코멘트</th>
                    <th>작성일</th>
                    <th>삭제</th>
                </tr>
<?PHP
            // DBMS 연결
            $db_conn = makeDBConnection();
            $sql = "select board_id, board_pid, contents, user_name, reg_date from mybulletin where board_pid = $writeNumber";
            // DBMS 연결 실패 여부 검사
            if(!$result = $db_conn ->query($sql)){
                echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
                exit(-1); // 시스템 종료
            }
            while($comment_row = $result->fetch_array()){
                $id = $comment_row['board_id'];
                echo ("<tr> \n");
                echo ("<td align = center> $comment_row[user_name] </td>\n");
                echo ("<td align = center> $comment_row[contents] </td>\n");
                // date_create("mysql 날짜 시간 값") -> DateTime 클래스의 객체 반환
                // date_format(DateTime 객체, 출력 포맷)
                echo ("<td align = center> ".date_format(date_create($comment_row['reg_date']),'Y-m-d')." </td>\n");

                if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_name']):
                echo<<<a
                <td><input id="view_comment_button" type="button" value="삭제" onClick="location.href='./delete.php?board_id=$id'"></td>\n 
a;
                endif;
                echo ("</tr> \n");
            }
                ?>
            </table>

</body>
</html>
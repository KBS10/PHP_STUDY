<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$mode = $_POST['mode'];
class db_info{
    const DB_URL    = "localhost";
    const USER_ID   = "root";
    const PASSWD    = "123456";
    const DB_NAME   = "ycj_test";
}
// DBMS 연결, 연결 성공 시 MySqli 객체, 실패 시 프로그램 종료
$db_conn = new mysqli(db_conf::DB_URL, db_conf::USER_ID, db_conf::PASSWD, db_conf::DB_NAME);

if($db_conn->connect_errno){
    echo "시스템 오류, 관리자에게 연락 바랍니다. (접속 실패)";
    exit(-1);
}
//echo "Model connection is successfully established <br>";

$sql = "";
// 학생 성적 입력
if($mode == "insert"){
    $sum = $_POST['kor'] + $_POST['eng'] + $_POST['math']; // 합계
    $avg = $sum / 3; // 평균

    //학생 성적 입력을 위한 SQL 작성
    $sql = "insert into student (name, kor, eng, math, sum, avg) values";
    $sql .= "('$_POST[name]', $_POST[kor], $_POST[eng], $_POST[math], $sum, $avg)";
//    echo $sql;

    if(!$db_conn->query($sql)){
        echo "시스템 오류, 관리자에게 연락 바랍니다. (쿼리 실패)";
        exit(-1);
    }
}else if($mode == "delete"){
    $sql ="";
    $sql = "delete from student where num = $_POST[num]";

    if(!$db_conn-> query($sql)){
        echo "시스템 오류, 관리자에게 연락 바랍니다. (delete 실패)";
        exit(-1);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <h1>성적 처리 프로그램 예제</h1>
    <fieldset style="width: 900px">
        <table style="width: 900px">
            <tr>
                <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method='post'>
                    <td bgcolor="white">
                        이름 : <input type="text" size="8" name="name">
                        국어 : <input type="text" size="5" name="kor">
                        영어 : <input type="text" size="5" name="eng">
                        수학 : <input type="text" size="5" name="math">
                        <input type="submit" value="입력">
                        <input type="hidden" name="mode" value="insert">
                    </td>
                </form>
            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method='post'>
                <td bgcolor="white">
                    <input type="submit" value="성적 정렬(오름차순)">
                    <input type="hidden" name="mode" value="ascend">
                </td>
            </form>
            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method='post'>
                <td bgcolor="white">
                    <input type="submit" value="성적 정렬(내림차순)">
                    <input type="hidden" name="mode" value="descend">
                </td>
            </form>
            </tr>
        </table>
    </fieldset>

    <table id="stdTable" style="width: 900px;" border="1px">
        <tr id="stdTable_row_1">
            <th>번호</th>
            <th>이름</th>
            <th>국어</th>
            <th>영어</th>
            <th>수학</th>
            <th>합계</th>
            <th>평균</th>
            <th>삭제</th>
        </tr>

        <?php
        // 오름차순 정렬 SQL
        if($mode == "ascend") $sql = "select * from student order by sum desc";
        // 내림차순 정렬
        else if($mode == "descend") $sql = "select * from student order by sum";
        else $sql = "select * from student";

        if(!($result = $db_conn->query($sql))){
            echo "시스템 오류, 관리자에게 연락 바랍니다. 결과 값 없을때";
            exit(-1);
        }

        $count = 1;

        while ($row = $result -> fetch_array()){
            $avg = round($row['avg'],2); //평균 값 소수점 2자리 반올림
            echo("<tr>");
            echo("<td bgcolor=white align = center> $count </td>");
            echo("<td bgcolor=white align = center> $row[name] </td>");
            echo("<td bgcolor=white align = center> $row[kor] </td>");
            echo("<td bgcolor=white align = center> $row[eng] </td>");
            echo("<td bgcolor=white align = center> $row[math] </td>");
            echo("<td bgcolor=white align = center> $row[sum] </td>");
            echo("<td bgcolor=white align = center> $avg </td>");

            // 삭제
            echo("<td bgcolor=white align = center>
            <form action='$_SERVER[PHP_SELF]' method='post'>
                <input type='submit' value='삭제'>
                <input type='hidden' name='mode' value='delete'>
                <input type='hidden' name='num' value='$row[num]'>
            </form>
         </td>");
            echo ("</tr>");

            $count++;
        }
        $db_conn->close();
        ?>
    </table>
</body>
</html>
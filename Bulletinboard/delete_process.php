<?php
require_once('DB.php');
require_once('my_util.php');

////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

$user_password = $_POST['user_passwd'];
$writeNumber = $_GET['board_id'];
// DBMS 연결
$db_conn = makeDBConnection();
$sql = "select user_passwd from mybulletin where board_id = $writeNumber";
if(!$result = $db_conn ->query($sql)){
    echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
    exit(-1); // 시스템 종료 : PHP 엔진 번역 작업 중지
}
$row = mysqli_fetch_assoc($result);
if(password_verify($user_password, $row['user_passwd'])) {
    $sql = "delete from mybulletin where board_id=$writeNumber";
    if(!$result = $db_conn ->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
        exit(-1); // 시스템 종료
    }
pageMove(Board_Info::FILENAME_LIST);
}else{
    echo "<script>alert('비밀번호가 틀립니다.');history.go(-1);</script>";exit;
}



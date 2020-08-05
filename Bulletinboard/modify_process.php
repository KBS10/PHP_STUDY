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
// POST 데이터 무결성 검사 및 HTML 태그 처리
if($getArrayData = dataValidation("POST", ['title', 'user_name', 'user_passwd', 'contents'], false)) {
    // DBMS 연결
    $db_conn = makeDBConnection();
    $sql = "select board_id, title, contents, user_name, user_passwd from mybulletin where board_id = $writeNumber";
    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
        exit(-1); // 시스템 종료
    }
    $row = mysqli_fetch_assoc($result);

    if(password_verify($getArrayData['user_passwd'], $row['user_passwd'])){

    $sql = "UPDATE ".db_info::DB_TABLE ." SET title='$getArrayData[title]',
     user_name='$getArrayData[user_name]',
     user_passwd='$getArrayData[user_passwd]',
     contents='$getArrayData[contents]' ,
     reg_date=now() WHERE board_id=$writeNumber";

        if(!$result = $db_conn ->query($sql)){
            echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
            exit(-1); // 시스템 종료
        }
        echo "<script>location.href='./view.php?board_id=$writeNumber';</script>";
    }else{
        echo "<script>alert('비밀번호가 틀립니다.');history.go(-1);</script>";exit;
    }
}else{
    // 입력 칸에 공백이 있을 경우
    prtErrorMsg("입력 값에 공란이 있습니다");
}

<?php
require_once('DB.php');
require_once('my_util.php');

////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////
if(isset($_GET['board_id']) && is_numeric($_GET['board_id'])){
    $board_id = $_GET['board_id'];
}else{
    prtErrorMsg("해당된 게시판이 없습니다.");
}

if($getArrayData = dataValidation("POST", ['comment', 'comment_writer', 'comment_password'], true)) {
    //  댓글 사용자 비밀번호 암호화
    $getArrayData['comment_password'] = password_hash($getArrayData['comment_password'], PASSWORD_DEFAULT);
    // DBMS 연결
    $db_conn = makeDBConnection();
    // mysql insert문
    $sql = "INSERT INTO " . db_info::DB_TABLE . "(board_pid, user_name, user_passwd, title, contents, reg_date) 
    VALUES('" .
        $board_id . "','" .
        $getArrayData['comment_writer'] . "','" .
        $getArrayData['comment_password'] . "','" .
        "  ' , '".
        $getArrayData['comment'] . "'," .
        "now());";
    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)) {
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
        exit(-1); // 시스템 종료
    }
    // 해당된 board_id View 페이지 이동
    pageMove(Board_Info::FILENAME_VIEW."?board_id=$board_id");
}else {
        // 입력 칸에 공백이 있을 경우
        prtErrorMsg("입력 값에 공란이 있습니다");
    }

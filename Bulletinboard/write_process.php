<?php
require_once('DB.php');
require_once('my_util.php');
// POST 데이터 무결성 검사 및 HTML 태그 처리
if($getArrayData = dataValidation("POST", ['title', 'user_name', 'user_passwd', 'content'], true)) {
    // 사용자 비밀번호 암호화
    $getArrayData['user_passwd'] = password_hash($getArrayData['user_passwd'], PASSWORD_DEFAULT);
    // DBMS 연결
    $db_conn = makeDBConnection();
        $sql = "INSERT INTO " . db_info::DB_TABLE . "(user_name, user_passwd, title, contents, reg_date) 
        VALUES('" . $getArrayData['user_name'] . "','" . $getArrayData['user_passwd'] . "','" .
        $getArrayData['title'] . "','" . $getArrayData['content'] . "'," . "now());";
    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
        exit(-1); // 시스템 종료
    }
    // 리스트 페이지 이동
    pageMove(Board_Info::FILENAME_LIST);
}else{
    prtErrorMsg("입력 값에 공란이 있습니다");
}
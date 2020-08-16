<?php
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
        // 게시글 DB 업데이트
        updateArticle($getArrayData['board_id'], $getArrayData['user_name'], $getArrayData['title'], $getArrayData['content']);
        pageMove(Board_Info::FILENAME_LIST."&board_id=".$getArrayData['board_id']);
    }else{
        prtErrorMsg("비밀번호가 틀립니다.");
    }
}else{
    // 입력 칸에 공백이 있을 경우
    prtErrorMsg("입력 값에 공란이 있습니다");
}
<?php
// POST 데이터 무결성 검사 및 HTML 태그 처리
if($getArrayData = dataValidation("POST", ['title', 'user_name', 'user_passwd', 'content'], false)) {

    if($passwordCheck = passwordCheck($_GET['board_id'], $getArrayData['user_passwd']) == 1){
        // 게시글 DB 업데이트
        orderDB("updateBoard",$_GET['board_id'], $getArrayData['user_name'], null, $getArrayData['title'], $getArrayData['content']);

        pageMove(Board_Info::FILENAME_VIEW."&board_id".$_GET['board_id']);
    }else{
        prtErrorMsg("비밀번호가 틀립니다.");
    }
}else{
    // 입력 칸에 공백이 있을 경우
    prtErrorMsg("입력 값에 공란이 있습니다");
}
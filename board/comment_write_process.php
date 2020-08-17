<?php

// POST 데이터 무결성 검사 및 HTML 태그 처리
if($getArray = dataValidation("POST", ['comment', 'comment_writer', 'comment_password'], true)) {
    // 사용자 비밀번호 암호화
    $getArray['comment_password'] = password_hash($getArray['comment_password'], PASSWORD_DEFAULT );

    // 댓글 DB 저장
    $result = orderDB("writeComment", $_GET['board_id'], $getArray['comment_writer'], $getArray['comment_password'], null ,$getArray['comment']);

    // 리스트 페이지 이동
    pageMove(Board_Info::FILENAME_VIEW."&board_id=".$_GET['board_id']);
} else {
    // POST 데이터 무결성 검사 실패
    prtErrorMsg("댓글 작성에 실패 하였습니다.");
}

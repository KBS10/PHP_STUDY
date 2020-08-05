<?php
require_once ('Model/bulletin_model.php');
require_once('Util/ycj_util.php');

// POST 데이터 무결성 검사 및 HTML 태그 처리
if($rcvdData = dataValidation("POST", ['board_id', 'user_name', 'user_passwd', 'content'], true)) {
    // 사용자 비밀번호 암호화
    $rcvdData['user_passwd'] = password_hash($rcvdData['user_passwd'], PASSWORD_DEFAULT );

    // 댓글 DB 저장
    writeComment($rcvdData['board_id'], $rcvdData['user_name'], $rcvdData['user_passwd'], $rcvdData['content']);

    // 리스트 페이지 이동
    pageRedirectWithPostMsg(BoardInfo::FILENAME_VIEW, ['board_id' => $rcvdData['board_id']]);
} else {
    // POST 데이터 무결성 검사 실패
    prtErrorMsg();
}


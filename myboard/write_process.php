<?php
require_once ('Model/bulletin_model.php');
require_once('Util/ycj_util.php');

// POST 데이터 무결성 검사 및 HTML 태그 처리
if($rcvdData = dataValidation("POST", ['title', 'user_name', 'user_passwd', 'content'], true)) {
    // 사용자 비밀번호 암호화
    $rcvdData['user_passwd'] = password_hash($rcvdData['user_passwd'], PASSWORD_DEFAULT );

    // 게시글 DB 작성
    writeArticle($rcvdData['user_name'], $rcvdData['user_passwd'], $rcvdData['title'], $rcvdData['content']);

    // 리스트 페이지 이동
    pageRedirect(BoardInfo::FILENAME_LIST);
} else {
    // POST 데이터 무결성 검사 실패
    prtAlertGoToList("입력 값에 공란이 있습니다");
}





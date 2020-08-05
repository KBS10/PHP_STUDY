<?php
require_once('Model/bulletin_model.php');
require_once('Util/ycj_util.php');

// POST 데이터 무결성 검사 및 HTML 태그 처리
if ($rcvdData = dataValidation("POST", ['board_id', 'title', 'user_name', 'user_passwd', 'content'], true)) {
    // 입력 패스워드 값 검사
    if (($pwCheckResult = doPwChecking($rcvdData['board_id'], $rcvdData['user_passwd'])) == DB_SYS_VALUE::CONTENT_PW_MATCHED) {

        // 게시글 DB 업데이트
        updateArticle($rcvdData['board_id'], $rcvdData['user_name'], $rcvdData['title'], $rcvdData['content']);

        // 리스트 페이지 이동
        pageRedirect(BoardInfo::FILENAME_LIST);
    } else {
        if($pwCheckResult == DB_SYS_VALUE::CONTENT_UNREGISTERED)
            prtErrorMsg();
        else if($pwCheckResult == DB_SYS_VALUE::CONTENT_PW_NOT_MATCHED)
            prtAlertGoToList("패스워드 미일치.");
        else
            prtErrorMsg();
    }
} else {
    // POST 데이터 무결성 검사 실패
    prtAlertGoToList("입력 값에 공란이 있습니다");
}

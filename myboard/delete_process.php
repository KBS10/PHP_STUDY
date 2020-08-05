<?php
require_once('Model/bulletin_model.php');
require_once('Util/ycj_util.php');


// POST 값 무결성 검사
if ($rcvdData = (isset($_POST['isComment']) ? dataValidation("POST", ['board_id', 'pboard_id', 'user_passwd'], false) :
    dataValidation("POST", ['board_id',  'user_passwd'], false))) {
    // 입력한 암호가 일치 할 경우 해당 글 삭제
    if (is_numeric($rcvdData['board_id']) && $rcvdData['board_id'] >= 0) {
        if (($pwCheckResult = doPwChecking($rcvdData['board_id'], $rcvdData['user_passwd'])) == DB_SYS_VALUE::CONTENT_PW_MATCHED) {

            // 게시글/댓글 삭제
            deleteArticleByBoardId($rcvdData['board_id']);

            // 리스트 페이지 이동
            if(isset($_POST['isComment']) && $_POST['isComment'] == true)
                pageRedirectWithPostMsg(BoardInfo::FILENAME_VIEW, ['board_id' => $rcvdData['pboard_id']]);
             else
                pageRedirect(BoardInfo::FILENAME_LIST);
        } else {
            if ($pwCheckResult == DB_SYS_VALUE::CONTENT_UNREGISTERED) {
                prtErrorMsg();
            }
            else if ($pwCheckResult == DB_SYS_VALUE::CONTENT_PW_NOT_MATCHED)
                prtAlertGoToList("패스워드 미일치");
            else
                prtErrorMsg();
        }
    } else
        // 유효하지 않은 board_id 값 수신
        prtAlertGoToList("잘못된 접근 입니다.");
} else
    // POST 데이터 무결성 검사 실패
    prtAlertGoToList("잘못된 접근 입니다.");

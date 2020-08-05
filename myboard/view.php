<?php
require_once ('Conf/board_conf.php');
require_once('Model/bulletin_model.php');
require_once('Util/ycj_util.php');

// POST로 넘어온 board_id 값을 이용하여,  해당 게시글 내용 획득
if (isset($_POST['board_id']) && is_numeric($_POST['board_id']) && $_POST['board_id'] >= 0)
    $board_id = $_POST['board_id'];
else {
    // POST 데이터 무결성 검사 실패
    prtAlertGoToList("잘못된 접근 입니다.");
}

// 조회수 1 증가
updateHitsCount($board_id);

// 게시글 획득
$article = getArticleByBoardId($board_id);

//  댓글 리스트 획득
$commentList = getCommentList($board_id);

// 페이지 번호, 검색 키워드 종류, 검색 키워드 무결성 검사
if (!($rcvdData = dataValidation("POST", ['page_num', 'keyword', 'keyword_text'], false))) {
    $rcvdData['page_num'] = isset($rcvdData['page_num']) ? $rcvdData['page_num'] : 0;
    $rcvdData['keyword'] = "";
    $rcvdData['keyword_text'] = "";
}
// 게시글 View 출력
// 게시글 레코드 :  $article
// 댓글 목록 :  $commentList
// Pagination, Searching 관련 변수 : $rcvdData['page_num'], $rcvdData['keyword'], $rcvdData['keyword_text']
include("View/view_template.php");
?>

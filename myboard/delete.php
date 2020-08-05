<?php
require_once('Conf/board_conf.php');

if (isset($_POST['board_id']) && is_numeric($_POST['board_id']) && $_POST['board_id'] >= 0)
    $board_id = $_POST['board_id'];
else
    // POST 데이터 무결성 검사 실패
    prtErrorMsg("잘못된 접근 입니다.");

$isComment = false;
if (isset($_POST['isComment']) && $_POST['isComment'] == true &&
    isset($_POST['pboard_id']) && $_POST['pboard_id'] == true) {
    $isComment = true;
    $pBoardId = $_POST['pboard_id'];
}

// 글 삭제 뷰 출력
// 삭제 글 번호 :  $board_id
// 댓글 플래그 : $isComment
// 댓글 번호 : $pBoardId
include("View/delete_template.php");
?>

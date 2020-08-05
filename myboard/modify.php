<?php
require_once('Model/bulletin_model.php');
require_once('Util/ycj_util.php');

if (isset($_POST['board_id']) && is_numeric($_POST['board_id']) && $_POST['board_id'] >= 0)
    $board_id = $_POST['board_id'];
else
    // POST 데이터 무결성 검사 실패
    prtAlertGoToList("잘못된 접근 입니다.");

// board_id 게시글 DBMS로 부터 획득
$article = getArticleByBoardId($board_id);

// 수정 글 View 출력
// 수정 글 레코드 :  $article
// 게시 글 번호 :  $board_id
include("View/modify_template.php");
?>
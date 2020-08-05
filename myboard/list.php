<?php
require_once('Util/pagination.php');
require_once('Util/ycj_util.php');

// 현 페이지 값을 POST 값으로 수신,
// 수신된 값이 없을 경우 현 페이지를 첫 페이지로 설정
if (isset($_POST['page_num']) && is_numeric($_POST['page_num']) && $_POST['page_num'] >= 0)
    $currentPageNum = $_POST['page_num'];
else
    $currentPageNum = 0;

//  Pagination 정보 획득
if( $rcvdData = dataValidation("POST", ['keyword', 'keyword_text'], false)) {
    // 검색 모드 경우
    $pagingInfo = getPagingInfo($currentPageNum, $rcvdData['keyword'], $rcvdData['keyword_text']);
} else {
    // 검색 모드가 아닐 경우
    $pagingInfo = getPagingInfo($currentPageNum, null, null);
}

//  DBMS로부터 현 페이지에 대한 글 목록 획득
$articleList = getArticleList($pagingInfo['totalRowNum'], $pagingInfo['pagingStartNum'], $pagingInfo['pagingEndNum'],
                                   $pagingInfo['isSearchingMode'], $pagingInfo['keyword'], $pagingInfo['keyword_text']);

// 페이지 번호 획득 : Ex) << 1, 2, 3, 4 >>
$pageNumbers = getPageNumberList($pagingInfo);


// View 출력
// Pagination 관련 변수 :  $pagingInfo
// Page 번호 :  $pageNumbers
// 게시글 목록: $articleList
include("View/list_template.php");
?>






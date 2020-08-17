<?php
require_once ('Conf/board_conf.php');

function getPagingInfo($argCurrentPageNum, $argKeyword, $argKeywordText)
{
    // Pagination 관련 변수
    $currentPageNum = $argCurrentPageNum; // 현 페이지 번호
    $pagingStartNum = 0; // 현 페이지 기준, 화면 출력 시작 글 번호
    $pagingEndNum = 0;  // 현 페이지 기준, 화면 출력 종료 글 번호
    $totalRowNum = 0;    // Model 테이블 내 저장된 총 게시글 수
    $totalPageNum = 0;   // 총 페이지 수

    // 검색 모드 판별 후 게시판에 등록된 글의 갯수 획득
    if (!is_null($argKeyword) && !is_null($argKeywordText)) {
        $isSearchingMode = true;
        // 등록된 총 게시글 수 획득 : 검색 모드
        $totalRowNum = getListNumber($argKeyword, $argKeywordText);
    }else{
        $isSearchingMode = false;
        // 등록된 총 게시글 수 획득 : 일반 모드
        $totalRowNum = getListNumber(null, null);
    }

    // 총 페이지 갯수 계산 : 게시글 총 갯수 / 페이지 당 게시글 수
    $totalPageNum = ceil($totalRowNum / Board_Info::NUM_OF_RECORDS_PER_PAG);

    // 현 페이지 번호 값 유효성 검사
    if ($currentPageNum < 0 || $currentPageNum >= $totalPageNum)
        $currentPageNum = 0;

    // 현 페이지 기준 출력 게시물 시작글 ,종료글 번호 계산
    $pagingStartNum = $currentPageNum * Board_Info::NUM_OF_RECORDS_PER_PAG;
    $pagingEndNum = Board_Info::NUM_OF_RECORDS_PER_PAG;

    // <<--- For debugging
    if (Board_Info::IS_DEBUG_MODE) {
        echo "For debugging <br>";
        echo "- Total Row : " . $totalRowNum . "<br>";
        echo "- Total Page Num : " . $totalPageNum . "<br>";
        echo "- pagingStartNum : " . $pagingStartNum . "<br>";
        echo "- pagingEndNum : " . $pagingEndNum . "<br>";
        echo "- currentPageNum : " . $currentPageNum . "<br>";
        echo "- searching keyword : " . $argKeyword . "<br>";
        echo "- searching keyword text : " . $argKeywordText . "<br>";
    }
    // -->>

    // 계산 된 paging information 반환
    return
        ["currentPageNum" => $currentPageNum,   // 현 페이지 번호
            "pagingStartNum" => $pagingStartNum,   // 현 페이지 기준 시작 글 번호
            "pagingEndNum" => $pagingEndNum,    // 현 페이지 기준 종료 글 번호
            "totalRowNum" => $totalRowNum,      // Model 테이블 내 저장된 총 게시글 수
            "totalPageNum" => $totalPageNum,     // 총 페이지 수
            "isSearchingMode" => $isSearchingMode,
            "keyword" => $argKeyword,
            "keyword_text" => $argKeywordText,
        ];
}

function getPageNumberList($argPagingInfo){
    $currentPageNum = $argPagingInfo['currentPageNum'];
    $totalPageNum = $argPagingInfo['totalPageNum'];
    echo "<div id='page' align='center'>";
    // 이전 부분
    if( $currentPageNum > 0){
        $PREV_PAGE = $currentPageNum - 1;
        echo "<a href='?page=list&currentPageNum=$PREV_PAGE'>이전</a>";}
    // 페이지 번호 리스트 출력
    for($icount = 0; $icount < $totalPageNum; $icount++){
        $list_show_page = $icount + 1;
        echo "<a href='?page=list&currentPageNum=$icount'> $list_show_page </a>";}
    // 다음 부분
    if($currentPageNum < $totalPageNum - 1){
        $NEXT_PAGE = $currentPageNum + 1;
        echo "<a href='?page=list&currentPageNum=$NEXT_PAGE'>다음</a>";}
}
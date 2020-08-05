<?php
require_once('Conf/board_conf.php');
require_once('Model/bulletin_model.php');


// 현 페이지 넘버에 대한 페이징 정보 획득
//   -> 현 페이지 기준, 화면 출력 시작 글 번호
//   -> 현 페이지 기준, 화면 출력 종료 글 번호
//   -> Model 테이블 내 저장된 총 게시글 수
//   -> 총 페이지 수
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
        $totalRowNum = getNumOfArticle($argKeyword, $argKeywordText);
    }else{
        $isSearchingMode = false;
        // 등록된 총 게시글 수 획득 : 일반 모드
        $totalRowNum = getNumOfArticle(null, null);
    }

    // 총 페이지 갯수 계산 : 게시글 총 갯수 / 페이지 당 게시글 수
    $totalPageNum = ceil($totalRowNum / BoardInfo::NUM_OF_RECORDS_PER_PAG);

    // 현 페이지 번호 값 유효성 검사
    if ($currentPageNum < 0 || $currentPageNum >= $totalPageNum)
        $currentPageNum = 0;

    // 현 페이지 기준 출력 게시물 시작글 ,종료글 번호 계산
    $pagingStartNum = $currentPageNum * BoardInfo::NUM_OF_RECORDS_PER_PAG;
    $pagingEndNum = BoardInfo::NUM_OF_RECORDS_PER_PAG;

    // <<--- For debugging
    if (BoardInfo::IS_DEBUG_MODE) {
        echo "For debugging<br>";
        echo "&nbsp&nbsp - Total Row : " . $totalRowNum . "<br>";
        echo "&nbsp&nbsp - Total Page Num : " . $totalPageNum . "<br>";
        echo "&nbsp&nbsp - pagingStartNum : " . $pagingStartNum . "<br>";
        echo "&nbsp&nbsp - pagingEndNum : " . $pagingEndNum . "<br>";
        echo "&nbsp&nbsp - currentPageNum : " . $currentPageNum . "<br>";
        echo "&nbsp&nbsp - searching keyword : " . $argKeyword . "<br>";
        echo "&nbsp&nbsp - searching keyword text : " . $argKeywordText . "<br>";
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

// 페이지 번호 HTML 출력
function getPageNumberList($argPagingInfo) {

    $result =  "<div align='center'>";

    // 등록된 게시글이 '0'일 경우
    if ($argPagingInfo['totalRowNum'] == 0)
        return $result."</div>";

    $currentPageNum = $argPagingInfo['currentPageNum'];
    $totalPageNum = $argPagingInfo['totalPageNum'];

    //  <<-- "<<" 페이지 점프 기능 구현
    //  "<<" 클릭 시 설정 되어 있는 페이지 만큼 뒤로 이동
    //  현 페이지가 BoardInfo::NUM_OF_PAGE 보다 클 경우 "<<" 클릭 활 성화
    if ($currentPageNum >= BoardInfo::NUM_OF_PAGE) {
        //  "<<" 클릭 시 Jump 페이지 번호 계산
        $jumpPageNum = (floor($currentPageNum / BoardInfo::NUM_OF_PAGE) - 1) * BoardInfo::NUM_OF_PAGE;

        // <<--
        // "<<" 기호 HTML 출력, "<<" 기호 마우스 클릭 시 JS(JavaScript)를 이용 하여
        // 계산된 Jump 페이지 번호 POST 값으로 전달 (list.php 파일 재 호출)

        // 검색 모드 동작 시
        if ($argPagingInfo['isSearchingMode']) {
            $result .= "<a href='#' onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]',
                            [{name : 'page_num', value : $jumpPageNum}, {name : 'keyword', value : '$argPagingInfo[keyword]'},
                             {name : 'keyword_text', value : '$argPagingInfo[keyword_text]'}])\"> << </a>&nbsp&nbsp\n";
        } else {
            $result .= "<a href='#' onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]', [{name : 'page_num', value : $jumpPageNum}])\"> << </a>&nbsp&nbsp\n";
        }
        //-->>

    } else {
        $result .= "<<&nbsp&nbsp";
    }
    // -->>

    // <<-- 페이지 번호  출력 Ex) 1, 2, 3, 4, 5
    // 시작, 종료 페이지 번호 계산
    // 시작 페이지 : 현 페이지 번호가 속한 Block에서 첫 번째 페이지 번호
    $startPageNum = (floor($currentPageNum / BoardInfo::NUM_OF_PAGE)) * BoardInfo::NUM_OF_PAGE;
    // 종료 페이지 : 현 페이지 번호가 속한 Block에서 마지막 페이지 번호
    $endPageNum = $startPageNum + BoardInfo::NUM_OF_PAGE < $totalPageNum
        ? $startPageNum + BoardInfo::NUM_OF_PAGE : $totalPageNum;

    for ($i = $startPageNum; $i < $endPageNum; $i++, $startPageNum++) {
        // 출력 페이지 번호가 현 페이지 번호와 같을 경우 글자 색 빨간색으로 변경
        $result .= "<a href=\"#\" " . ($i == $currentPageNum ? "style=\"color: red\" " : null);

        // 페이지 번호 HTML 출력, 페이지 번호 마우스 클릭 시 JS(JavaScript)를 이용 하여
        // 클릭된 페이지 번호 POST 값으로 전달 (list.php 파일 재 호출)

        // 검색 모드 동작 시
        if ($argPagingInfo['isSearchingMode']) {
            $result .= "onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]',
                           [{name : 'page_num', value : $i}, {name : 'keyword', value : '$argPagingInfo[keyword]'},
                            {name : 'keyword_text', value : '$argPagingInfo[keyword_text]'}])\">" . ($i + 1) . "</a>&nbsp&nbsp\n";
        } else {
            $result .= "onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]',  [{name : 'page_num', value : $i}])\" >" . ($i + 1) . "</a>&nbsp&nbsp\n";
        }
    }
    // -->>

    //  <<-- ">>" 페이지 점프 기능 구현
    // 현 페이지 기준 설정된 페이지 만큼 앞으로 이동할 페이지가 있을 경우 활성화
    if (floor($currentPageNum / BoardInfo::NUM_OF_PAGE) < floor(($totalPageNum - 1) / BoardInfo::NUM_OF_PAGE)) {
        //  ">>" 클릭 시 Jump 페이지 번호 계산
        $jumpPageNum = (floor($currentPageNum / BoardInfo::NUM_OF_PAGE) + 1) * BoardInfo::NUM_OF_PAGE;

        // ">>" 기호 HTML 출력, ">>" 기호 마우스 클릭 시 JS(JavaScript)를 이용 하여
        // 계산된 Jump 페이지 번호 POST 값으로 전달 (list.php 파일 재 호출)

        // 검색 모드일 경우 : 검색 키워드 항목, 검색어 POST 전달
        if ($argPagingInfo['isSearchingMode']) {
            $result .= "<a href='#' onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]',
                            [{name : 'page_num', value : $jumpPageNum}, {name : 'keyword', value : '$argPagingInfo[keyword]'},
                             {name : 'keyword_text', value : '$argPagingInfo[keyword_text]'}])\">>> </a>&nbsp&nbsp\n";
        } else {
            $result .= "<a href='#' onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]', [{name : 'page_num', value : $jumpPageNum }])\"> >> </a>\n";
        }
    } else {
        $result .= "&nbsp&nbsp>>";
    }
    // -->>
    $result .= "</div>";

    return $result;
}


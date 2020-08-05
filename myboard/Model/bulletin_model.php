<?php
require_once('db_util.php');

// 게시글 검색 관련  SQL 문 작성
function getSqlForSearching($argKeyword, $argKeywordText)
{
    $searchingSql = " like '%$argKeywordText%'";

    switch ($argKeyword) {
        case "title":
            $searchingSql = " title" . $searchingSql;
            break;
        case "content":
            $searchingSql = " contents" . $searchingSql;
            break;
        case "user_name":
            $searchingSql = " user_name" . $searchingSql;
            break;
        case "title_content":
            $searchingSql = " title" . $searchingSql . " or " . "contents" . $searchingSql;
            break;
    }

    return $searchingSql;
}

// 게시판에 등록된 글의 갯수 획득 :
//   $argKeyword : 검색 키워드 종류
//   $argKeywordText : 검색어
//   일반 검색 (검색 모드가 아닐 경우)인 경우 $argKeyword, $argKeywordText 모두 null 값
function getNumOfArticle($argKeyword, $argKeywordText)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    $searchingSql = "";

    // 검색 조건 검사, 검색 조건 일 경우 검색 관련 SQL문 추가
    if (!is_null($argKeyword) && !is_null($argKeywordText)) {
        $searchingSql = getSqlForSearching($argKeyword, $argKeywordText);
    }

    // <<-- 현재 등록된 게시글 총 갯수 획득
    $sql = "select count(*) from " . DbInfo::DB_TABLE . ($searchingSql != "" ? " where " . $searchingSql : "");

    // SQL 처리 에러
    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();

    return $result->fetch_array()[0];
}


// 게시글 목록 획득
function getArticleList($argTotalRowNum, $argStartNum, $argEndNum, $argIsSearchingMode, $argSearchKeywordType, $argSearchKeyword)
{
    // 등록된 게시글이 '0'일 경우
    if ($argTotalRowNum == 0)
        return [];

    // DBMS 연결
    $db_conn = makeDBConnection();

    // SQL문 작성 : 댓글을 제외한 모든 게시글 입력 역순으로 획득
    if ($argIsSearchingMode) {
        $sql = "select * from " . DbInfo::DB_TABLE . " where " . getSqlForSearching($argSearchKeywordType, $argSearchKeyword) . " and board_pid = 0 order by board_id desc";
    } else {
        $sql = "select * from " . DbInfo::DB_TABLE . " where board_pid = 0 order by board_id desc";
    }

    // Pagination SQL 구문 추가
    $sql .= " limit " . $argStartNum . ", " . $argEndNum;

    // DB SQL 처리 에러
    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();

    // 검색 된 게시글 Record 집합을 Object 배열형으로 반환
    $articleList = [];
    while ($article = $result->fetch_object()) {
        $articleList[] = $article;
    }

    return $articleList;
}

// 게시글 조회수 '1' 증가
function updateHitsCount($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // 조회수 1증가
    $sql = "update " . DbInfo::DB_TABLE . " set hits=hits+1 where board_id=" . $argBoardId;

    if (!$db_conn->query($sql)) {
        prtErrorMsg();
    }
}

// board_id 활용, 특정 게시글 획득.
// mysqli_result Object 형 반환
function getArticleByBoardId($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // 지정 board_id 게시글 획득
    $sql = "select * from " . DbInfo::DB_TABLE . " where board_id=" . $argBoardId;

    //  선택 게시글이 존재하지 않는 경우
    if (!($result = $db_conn->query($sql))) {
        prtErrorMsg();
    }

    return $result->fetch_object();
}

// 댓글 리스트 획득: 특정 게시글에 포함되는 댓글 리스트
// $argBoardId : 게시글 ID
function getCommentList($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // board_id 기준 게시글 내 작성된 댓글 리스트 획득
    $sql = "select * from " . DbInfo::DB_TABLE . " where board_pid=" . $argBoardId;

    // DB SQL 처리 에러
    if (!($result = $db_conn->query($sql))) {
        prtErrorMsg();
    }

    // 검색 된 댓글 Record 집합을 Object 배열형으로 반환
    $commentList = [];
    while ($comment = $result->fetch_object()) {
        $commentList[] = $comment;
    }

    return $commentList;
}

// 댓글 작성
// $argBoardId : 게시글 번호
// $argUserName : 댓글 작성자
// $argUserPasswd : 댓글 암호
// $argContent : 댓글 내용
function writeComment($argBoardId, $argUserName, $argUserPasswd, $argContent)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // 댓글 작성
    $sql = "insert into " . DbInfo::DB_TABLE . " values(0, " . $argBoardId . ", '" .
        $argUserName . "', '" .
        $argUserPasswd . "', '', '" .
        $argContent . "', " .
        "0 , now())";

    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();
}

// 패스워드 일치 점검
// $argBoardId : 게시글 번호
// $argUserPasswd : 사용자 입력 패스워드
function doPwChecking($argBoardId, $argUserPasswd)
{
    $dbConn = makeDBConnection();

    $sql = "select *  from " . DbInfo::DB_TABLE . " where board_id='$argBoardId'";

    if (!($result = $dbConn->query($sql)))
        prtErrorMsg();

    // 등록 되지 않은 게시글
    if ($result->num_rows == 0) {
        return DB_SYS_VALUE::CONTENT_UNREGISTERED;
    } else {
        $userRecord = $result->fetch_array();
        // 패스워드 일치
        if (password_verify($argUserPasswd, $userRecord['user_passwd'])) {
            return DB_SYS_VALUE::CONTENT_PW_MATCHED;
        } else {
            // 패스워드 미 일치
            return DB_SYS_VALUE::CONTENT_PW_NOT_MATCHED;
        }
    }
}

// 특정 게시글 삭제
// $argBoardId : 삭제 게시글 번호
function deleteArticleByBoardId($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // board_id 게시글 삭제
    $sql = "delete  from " . DbInfo::DB_TABLE . " where board_id='" . $argBoardId . "'";

    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();
}

// 게시글 업데이트
// $argBoardId : 게시글 번호
// $argUserName : 게시글 작성자 이름
// $argTitle : 게시글 제목
// $argContent : 게시글 내용
function updateArticle($argBoardId, $argUserName, $argTitle, $argContent)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    //  board_id 기준, 게시글 수정 SQL
    $sql = "update " . DbInfo::DB_TABLE . " set user_name='$argUserName', 
                    title='$argTitle', contents='$argContent', reg_date=now() where board_id=$argBoardId";

    //  SQL 처리 실패
    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();
}

//  게시글 작성
// $argUserName : 게시글 작성자 이름
// $argUserPasswd : 게시글 암호
// $argTitle : 게시글 제목
// $argContent : 게시글 내용
function writeArticle($argUserName, $argUserPasswd, $argTitle, $argContent) {
    // DBMS 연결
    $db_conn = makeDBConnection();

    // SQL문 작성
    $sql = "insert into ".DbInfo::DB_TABLE." values(0, 0, '".
        $argUserName."', '".
        $argUserPasswd."', '".
        $argTitle."', '".
        $argContent."', ".
        "0 , now())";

    // SQL 처리 실패
    if(!($result = $db_conn->query($sql)))
        prtErrorMsg();
}
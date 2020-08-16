<?php
require_once ('db_conf.php');
require_once ('db_util.php');

function getSqlForSearching($argKeyword, $argKeywordText){

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

function getCommentList($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // board_id 기준 게시글 내 작성된 댓글 리스트 획득
    $sql = "select * from " . DB_Info::DB_TABLE . " where board_pid=" . $argBoardId;

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

function getArticleByBoardId($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // 지정 board_id 게시글 획득
    $sql = "select * from " . DB_Info::DB_TABLE . " where board_id=" . $argBoardId;

    //  선택 게시글이 존재하지 않는 경우
    if (!($result = $db_conn->query($sql))) {
        prtErrorMsg();
    }

    return $result->fetch_object();
}

// 게시글 조회수 '1' 증가
function updateHitsCount($argBoardId){
    // DBMS 연결
    $db_conn = makeDBConnection();

    // 조회수 1증가
    $sql = "update " . DB_Info::DB_TABLE . " set hits=hits+1 where board_id=" . $argBoardId;

    if (!$db_conn->query($sql)) {
        prtErrorMsg();
    }
}

// 특정 게시글 삭제
function deleteArticleByBoardId($argBoardId)
{
    // DBMS 연결
    $db_conn = makeDBConnection();

    // board_id 게시글 삭제
    $sql = "delete  from " . DbInfo::DB_TABLE . " where board_id='" . $argBoardId . "'";

    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();
}

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
    $sql = "select count(*) from " . DB_Info::DB_TABLE . ($searchingSql != "" ? " where " . $searchingSql : "");

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
        $sql = "select * from " . DB_Info::DB_TABLE . " where " . getSqlForSearching($argSearchKeywordType, $argSearchKeyword) . " and board_pid = 0 order by board_id desc";
    } else {
        $sql = "select * from " . DB_Info::DB_TABLE . " where board_pid = 0 order by board_id desc";
    }

    // Pagination SQL 구문 추가
    $sql .= " limit " . $argStartNum . ", " . $argEndNum;

    // DB SQL 처리 에러
    if (!($result = $db_conn->query($sql)))
        prtErrorMsg("로그인에 실패하였습니다.");

    // 검색 된 게시글 Record 집합을 Object 배열형으로 반환
    $articleList = [];
    while ($article = $result->fetch_object()) {
        $articleList[] = $article;
    }

    return $articleList;
}

function loginBoard($argID){
    $db_conn = makeDBConnection();

    $sql = "select * from user_info where id = '$argID'";

    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)){
        prtErrorMsg("로그인에 실패하였습니다.");
    }
    $row = $result->fetch_array();

    $_SESSION['id']         = $row['id'];
    $_SESSION['password']   = $row['password'];
    $_SESSION['name']       = $row['name'];
    $_SESSION['grade']      = $row['grade'];
    $_SESSION['age']        = $row['age'];
}

function writeArticle($argUserName, $argUserPassword, $argTitle, $argContents){
    $db_conn = makeDBConnection();

    $sql = "INSERT INTO " . DB_Info::DB_TABLE . " (user_name, user_passwd, title, contents, reg_date) 
            VALUES ('$argUserName','$argUserPassword','$argTitle','$argContents',now())" ;
    
    if(!$result = $db_conn ->query($sql)){
        prtErrorMsg("글 작성에 실패하였습니다.");
    }
}


function writeComment($argBoardPid, $argUserName, $argUserPassword, $argContents){
    $db_conn = makeDBConnection();

    $sql = "INSERT INTO " . DB_Info::DB_TABLE . " (board_pid, user_name, user_passwd, title, contents, reg_date) 
            VALUES ('$argBoardPid','$argUserName', '$argUserPassword', ' ' ,'$argContents',now())" ;

    if(!$result = $db_conn ->query($sql)){
        prtErrorMsg("글 작성에 실패하였습니다.");
    }
}
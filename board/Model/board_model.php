<?php
require_once ('db_conf.php');
require_once ('db_util.php');

function getSearching($argKeyword, $argKeywordText){
    $searchingSql = " like '%$argKeywordText%'";
    switch ($argKeyword) {
        case "title":
            $searchingSql = " title" . $searchingSql;
            break;
        case "contents":
            $searchingSql = " contents" . $searchingSql;
            break;
        case "user_name":
            $searchingSql = " user_name" . $searchingSql;
            break;
        case "titlePlusContents":
            $searchingSql = " title" . $searchingSql . " or " . "contents" . $searchingSql;
            break;
    }
    return $searchingSql;
}

function getCommentList($argBoardId)
{
    $db_conn = makeDBConnection();

    $sql = "select * from " . DB_Info::DB_TABLE . " where board_pid=" . $argBoardId;

    if (!($result = $db_conn->query($sql))) {
        prtErrorMsg("DB 연결에 실패하였습니다.");
    }
    $commentList = [];
    while ($comment = $result->fetch_object()) {
        $commentList[] = $comment;
    }
    return $commentList;
}


function passwordCheck($argBoardId, $argUserPasswd)
{
    $db_conn = makeDBConnection();
    $sql = "select *  from " . DB_Info::DB_TABLE . " where board_id='$argBoardId'";

    if (!($result = $db_conn->query($sql)))
        prtErrorMsg("DB 연결에 실패하였습니다.");
        $userInfo = $result->fetch_array();
        // 패스워드 일치
        if (password_verify($argUserPasswd, $userInfo['user_passwd'])) {
            return 1;
        }
        // 패스워드 미일치
        else {
            return 0;
        }
}


function getArticleByBoardId($argBoardId)
{
    $db_conn = makeDBConnection();
    $sql = "select * from " . DB_Info::DB_TABLE . " where board_id=" . $argBoardId;
    if (!($result = $db_conn->query($sql))) {
        prtErrorMsg("DB 연결에 실패하였습니다.");
    }
    return $result->fetch_object();
}

function getListNumber($argKeyword, $argKeywordText)
{
    $db_conn = makeDBConnection();
    $searchingSql = "";

    if (!is_null($argKeyword) && !is_null($argKeywordText)) {
        $searchingSql = getSearching($argKeyword, $argKeywordText);
    }
    $sql = "select count(*) from " . DB_Info::DB_TABLE . ($searchingSql != "" ? " where " . $searchingSql : "");

    if (!($result = $db_conn->query($sql)))
        prtErrorMsg();

    return $result->fetch_array()[0];
}

function getBoardList($argTotalRowNum, $argStartNum, $argEndNum, $argIsSearchingMode, $argSearchKeywordType, $argSearchKeyword)
{
    if ($argTotalRowNum == 0)
        return [];
    $db_conn = makeDBConnection();
    if ($argIsSearchingMode) {
        $sql = "select * from " . DB_Info::DB_TABLE . " where " . getSearching($argSearchKeywordType, $argSearchKeyword) . " and board_pid = 0 order by board_id desc";
    } else {
        $sql = "select * from " . DB_Info::DB_TABLE . " where board_pid = 0 order by board_id desc";
    }
    $sql .= " limit " . $argStartNum . ", " . $argEndNum;
    if (!($result = $db_conn->query($sql)))
        prtErrorMsg("DB 연결에 실패하였습니다.");
    $articleList = [];
    while ($article = $result->fetch_object()) {
        $articleList[] = $article;
    }
    return $articleList;
}

function loginBoard($argID){
    $db_conn = makeDBConnection();
    $sql = "select * from user_info where id = '$argID'";
    if(!$result = $db_conn ->query($sql)){
        prtErrorMsg("DB 연결에 실패하였습니다.");
    }
    $row = $result->fetch_array();
    $_SESSION['id']         = $row['id'];
    $_SESSION['password']   = $row['password'];
    $_SESSION['name']       = $row['name'];
    $_SESSION['grade']      = $row['grade'];
    $_SESSION['age']        = $row['age'];
}

function orderDB($argWrite,$argBoardId,$argUserName,$argPassword, $argTitle, $argContents){
    $db_conn = makeDBConnection();
    switch ($argWrite){
        case "writeBoard" :
            $sql = "INSERT INTO " . DB_Info::DB_TABLE . " (user_name, user_passwd, title, contents, reg_date) 
            VALUES ('$argUserName','$argPassword','$argTitle','$argContents',now())" ;
            break;
        case "writeComment":
            $sql = "INSERT INTO " . DB_Info::DB_TABLE . " (board_pid, user_name, user_passwd, title, contents, reg_date) 
            VALUES ('$argBoardId','$argUserName', '$argPassword', ' ' ,'$argContents',now())" ;
            break;
        case "updateBoard":
            $sql = "update " . DB_Info::DB_TABLE . " set user_name='$argUserName', 
                    title='$argTitle', contents='$argContents', reg_date=now() where board_id=$argBoardId";
            break;
        case "updateCount":
            $sql = "update " . DB_Info::DB_TABLE . " set hits=hits+1 where board_id=" . $argBoardId;
            break;
        case "deleteBoard":
            $sql = "delete  from " . DB_Info::DB_TABLE . " where board_id='" . $argBoardId . "'";
            break;
    }
    if(!$result = $db_conn ->query($sql)){
        prtErrorMsg("DB 연결에 실패하였습니다.");
    }
}
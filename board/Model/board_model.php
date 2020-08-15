<?php
require_once ('db_conf.php');
require_once ('db_util.php');

function selectBoardList($argPagingInfo){
    $db_conn = makeDBConnection();

    if($argPagingInfo['isSearchingMode']){
        $sql = "select * from " .DB_Info::DB_TABLE. " where " .$argPagingInfo['searchingSql'] ." and board_pid = 0 order by board_id desc";
    }else{
        $sql = "select * from " .DB_Info::DB_TABLE." where board_pid = 0 order by board_id desc";
    }

    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)){
        prtErrorMsg("로그인에 실패하였습니다.");
    }
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

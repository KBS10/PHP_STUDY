<?php
require_once('db_conf.php');
require_once('Util/ycj_util.php');

// DBMS 연결 함수, 연결 성공 시 MySqli 객체 반환, 실패 시 프로그램 종료
function makeDBConnection()
{
    // DBMS 연결, mysqli 객체 반환
    $db_conn = new mysqli(DbInfo::DB_URL, DbInfo::USER_ID, DbInfo::PASSWD, DbInfo::DB_NAME);

    // DB 연결 에러
    if ($db_conn->connect_errno) {
        prtErrorMsg();
    }

    return $db_conn;
}

?>
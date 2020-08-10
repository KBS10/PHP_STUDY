<?php
require_once ('db_conf.php');
// DBMS 연결 함수, 연결 성공 시 MySqli 객체 반환, 실패 시 프로그램 종료
function makeDBConnection()
{
    // DBMS 연결, mysqli 객체 반환
    $db_conn = new mysqli(DB_Info::DB_URL, DB_Info::USER_ID, DB_Info::PASSWD, DB_Info::DB_NAME);

    // DB 연결 에러
    if ($db_conn->connect_errno) {
        prtErrorMsg();
    }

    return $db_conn;
}

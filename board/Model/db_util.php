<?php
require_once ('db_conf.php');
function makeDBConnection(){
    // DBMS 연결
    $db_conn = new mysqli(DB_Info::DB_URL, DB_Info::USER_ID, DB_Info::PASSWD, DB_Info::DB_NAME);

    // DBMS 연결 실패 여부 검사
    if($db_conn->connect_errno){
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 1)";
        exit(-1); // 시스템 종료
    }
    return $db_conn;
}
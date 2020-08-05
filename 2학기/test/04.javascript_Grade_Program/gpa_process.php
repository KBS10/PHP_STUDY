<?php

class db_info{
    const DB_URL     = "localhost";
    const USER_ID    = "root";
    const PASSWD     = "123456";
    const DB_NAME    = "ycj_test";
}

class RspMsg
{
    public $cmdType, $rspStatus, $rspData;

    public function __construct($argMsgType, $argRspStatus, $argRspData)
    {
        $this->cmdType    = $argMsgType;    // 명령어 종류
        $this->rspStatus    = $argRspStatus;   // 요청 처리 결과
        $this->rspData      = $argRspData;     // 응답 데이터
    }
}

// DBMS 연결
function makeDBConnection()
{
    $db_conn = new mysqli(db_conf::DB_URL, db_conf::USER_ID, db_conf::PASSWD, db_conf::DB_NAME);

    // DBMS 연결  실패 여부 검사
    if ($db_conn->connect_errno) {
        echo "Failed to connect to the MySQL Server";
        exit(-1);
    }
    return $db_conn;
}

// DBMS 테이블 레코드 반환
function getAllRecordsFromTable() {
    $dbConn = makeDBConnection();

    $sql_stmt = 'select * from gpa';

    if ($result = $dbConn->query($sql_stmt)) {
        return  $result->fetch_all();
    } else {
        return null;
    }
}

// DBMS 데이터 삽입
function insetStdGradeToTable($argObj) {
    $dbConn = makeDBConnection();

    $sql_stmt = "insert into gpa values($argObj->id, \"{$argObj->name}\", {$argObj->courseGrade[0]}, 
                        {$argObj->courseGrade[1]}, {$argObj->courseGrade[2]}, {$argObj->sum}, {$argObj->avg})";

    if ($result = $dbConn->query($sql_stmt)) {
        $dbConn->close();
        return true;
    }

    $dbConn->close();
    return false;
}

// 입력 값을 JSON으로 decoding 실시 -> 객체 생성
$receivedData = json_decode(file_get_contents('php://input'));
$rspMsg = null;

// 클라이언트로 부터 수신한 메시지 분석 후, 응답 메시지 작성
switch ($receivedData->cmdType) {
    case "listup": // 학생 성적 조회
        $rspData = getAllRecordsFromTable();
        $rspMsg = new RspMsg("listup", ($rspData != null ? true : false), $rspData);
        break;
    case "insert": // 학생 성적 입력
        $rspMsg = new RspMsg("insert", insetStdGradeToTable($receivedData->data), $receivedData->data);
        break;
}

// 객체 값을 JSON 포맷 인코딩 후 출력
echo json_encode($rspMsg);



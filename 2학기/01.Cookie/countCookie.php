<?php
require_once('db_conf.php');
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////
//DBMS 연결
function makeDBConnection(){
    // DBMS 연결
    $db_conn = new mysqli(db_conf::DB_URL, db_conf::USER_ID,
                            db_conf::PASSWD, db_conf::DB_NAME);

    // DBMS 연결 실패 여부 검사
    if($db_conn->connect_errno){
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다.";
        exit(-1); // 시스템 종료
    }
    return $db_conn;
}

// 방문자 수 1 증가
function updateVisitingCounter(){
    $db_conn = makeDBConnection();

    // mysql vc 1 증가 update
    $sql = "update visitorcount set vc=vc+1";

    if(!$db_conn->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다.";
        exit(-1); // 시스템 종료
    }
}

// 현재 방문자 수 체크 (총 방문자 수)
function allVisitingCounter(){
    $db_conn = makeDBConnection();

    // visitorcount 검색
    $sql = "select * from visitorcount";

    if(!$result = $db_conn ->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다.";
        exit(-1); // 시스템 종료
    }
    return $result->fetch_array()[0];
}
// 쿠키값 없을 경우
if(!isset($_COOKIE['visit'])){
    updateVisitingCounter();
    // 쿠키 이름 : visit, 쿠키 값 : boolean, 만료 시간 : 0 ( 접속자가 브라우저를 종료 시 쿠키 사라짐 )
    setcookie('visit','true',0);
}

// chrome 에서 network페에지에 cookie가 뜨지 않는 관계로 cookie값 확인
// echo $_COOKIE['visit'];
// 쿠키가 있거나 없거나 총 방문자 수는 출력
echo "총 방문자 수 : " .allVisitingCounter();

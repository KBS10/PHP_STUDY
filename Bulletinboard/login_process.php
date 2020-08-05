<?php
require_once('DB.php');
require_once('my_util.php');
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();

//////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
//////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// main.php에서 id와 password를 입력하지 않았을때,
// main.php에서 넘어온 값이 session값이랑 다를경우
// 로그인이 실패시 실행되는 함수
function failureLogin(){
    prtErrorMsg("로그인에 실패하였습니다.");
}
// 로그인이 성공시 실행되는 함수
function showUserInfo(){
    pageMove(Board_Info::FILENAME_LIST);
}
// 다시입력하기 button을 눌렀을 때 list.php move
if(array_key_exists('re_Input',$_POST)){
    pageMove(Board_Info::FILENAME_LIST);
}
// 회원정보보기 button을 눌렀을 때 list.php move
if(array_key_exists('viewUserInfo',$_POST)){
    pageMove(Board_Info::FILENAME_LIST);
}
///////////////////////////////////////////////////////////////////////////////////

if($getArrayData = dataValidation("POST", ['id', 'password'], true)) {
    // DBMS 연결
    $db_conn = makeDBConnection();
    $sql = "select * from user_info where id = '$getArrayData[id]'";
    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
        exit(-1); // 시스템 종료
    }
    while($row = mysqli_fetch_array($result)){
        $_SESSION['id']         = $row['id'];
        $_SESSION['password']   = $row['password'];
        $_SESSION['name']       = $row['name'];
        $_SESSION['grade']      = $row['grade'];
        $_SESSION['age']        = $row['age'];
    }
    showUserInfo();
}else{
    failureLogin();
}
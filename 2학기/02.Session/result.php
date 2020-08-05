<?php
require_once('db_conf.php');
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();

////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// main.php에서 id와 password를 입력하지 않았을때,
// main.php에서 넘어온 값이 session값이랑 다를경우
// 로그인이 실패시 실행되는 함수
function failureLogin(){
    echo "로그인에 실패하였습니다.";
    echo "<form method='post'>
            <input type='submit' value = '다시입력하기' name='re_Input'>
            </form>";
}
// 로그인이 성공시 실행되는 함수
function showUserInfo(){
    echo "성공적으로 로그인 하였습니다.";
    echo "<form method='post'>
        <input type='submit' value = '회원정보보기' name='viewUserInfo'>
        </form>";
}
// 다시입력하기 button을 눌렀을 때 main.php move
if(array_key_exists('re_Input',$_POST)){
    echo "<script>location.href='main.php';</script>";
}
// 회원정보보기 button을 눌렀을 때 main.php move
if(array_key_exists('viewUserInfo',$_POST)){
    echo "<script>location.href='main.php';</script>";
}
///////////////////////////////////////////////////////////////////////////////////

//DBMS 연결
function makeDBConnection(){
    // DBMS 연결
    $db_conn = new mysqli(db_info::DB_URL, db_info::USER_ID,
        db_info::PASSWD, db_info::DB_NAME);

    // DBMS 연결 실패 여부 검사
    if($db_conn->connect_errno){
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 1)";
        exit(-1); // 시스템 종료
    }
    return $db_conn;
}

// main.php 에서 넘어온 아이디 값과 패스워드 변수 저장
$id = $_POST['id']; // 아이디
$password = $_POST['password']; // 패스워드
// main.php에서 값이 잘 넘어왔는지 확인
//echo $id, $password;

// DBMS 연결
$db_conn = makeDBConnection();
// user_info 검색
$sql = "select * from user_info";
if(!$result = $db_conn ->query($sql)){
    echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
    exit(-1); // 시스템 종료
}
$record = $result->fetch_row();
if($id == $record['0'] && $password == $record['1']){
    $_SESSION['id']         = $record[0];
    $_SESSION['password']   = $record[1];
    $_SESSION['name']       = $record[2];
    $_SESSION['grade']      = $record[3];
    $_SESSION['age']        = $record[4];
//    echo $_SESSION['id'], $_SESSION['password'], $_SESSION['name'], $_SESSION['grade'], $_SESSION['age'];
    showUserInfo();
}else{
    failureLogin();
}
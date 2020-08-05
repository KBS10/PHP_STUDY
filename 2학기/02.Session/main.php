<?php
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();

//////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
//////////////////////////////////////////////////////////

if($_SESSION['id'] == null || $_SESSION['password'] == null ){
?>
<form name="login_form" action="result.php" method="post">
    ID : <input type="text" name="id"><br>
    암호 : <input type="password" name="password"><br><br>
    <input type="submit" name="로그인하기" value="Login">
</form>

<?php
}else{
    echo $_SESSION['name']."님이 로그인 하셨습니다.<br>";
    echo "나이 : " .$_SESSION['age'] ."<br>";
    echo "회원등급 : " .$_SESSION['grade'];
    echo "<form method='post'>
        <input type='submit' value = '로그아웃' name='logout'>
        </form>";
}

function logout(){
    if($_SESSION['id']!=null){
        session_destroy();
    }
    echo "<script>location.href='main.php';</script>";
}

if(array_key_exists('logout',$_POST)){
    logout();
}


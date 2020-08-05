<?php
// session 시작
echo "session 시작 <br>";
$sessionStartValue = session_start();
echo $sessionStartValue;

//현 세션 내 데이터 저장
// 웹 서버 측에 저장
$_SESSION['name']   = "BeomSoo Kim";
$_SESSION['age']    = 23;
$_SESSION['univ']   = "Yeungjin Univ";
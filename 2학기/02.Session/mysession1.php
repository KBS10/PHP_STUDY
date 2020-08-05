<?php
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();

echo "세션 서버에 저장";
//웹 서버 측에 저장
$_SESSION['name']   = "BeomSoo Kim";
$_SESSION['age']    = 23;
$_SESSION['univ']   = "Yeungjin Univ";
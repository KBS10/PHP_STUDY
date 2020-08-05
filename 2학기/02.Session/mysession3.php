<?php
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();


//session_destroy();
//echo "$_SESSION 배열 모든 값 삭제";

//현 세션에 저장된 세션 값 출력
echo $_SESSION['name']."<br>";
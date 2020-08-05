<?php
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();

// 현 세션에 저장된 변수 값 삭제
echo "현 세션에 저장된 변수 값 삭제";
unset($_SESSION['name']);

// 현 세션에 저장된 변수값 모두 출력
foreach($_SESSION as $key => $value)
    echo $key.":".$value."<br>";
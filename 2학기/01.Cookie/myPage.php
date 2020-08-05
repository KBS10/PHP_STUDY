<?php
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

// 쿠키 생성 : detp="cominfo"
echo "쿠키 생성";
//setcookie('name','bsKim');
//setcookie('age','23');
//setcookie('dept','cominfo');
//setcookie('univ','Yeungjin Univ');
//setcookie('position','student');
//setcookie('otherinfo');


//setcookie('name','bsKim', time() + 5);              // 현재 시간 기준 5초 뒤 쿠키 소멸
//setcookie('age','23', time() + 60 * 60 * 24);       // 현재 시간 기준 1일 뒤 소멸
//setcookie('dept','cominfo', 0);                     // 브라우저 종료 시 소멸
//setcookie('univ','Yeungjin Univ');                  // 브라우저 종료 시 소멸
//setcookie('position','student', time() - 3600);     // 현 쿠키 삭제, 과거 시간

// 현 디렉토리 내 파일만 쿠키 적용
//setcookie('FOO', "BAR", 0);
// 현 디렉토리 내 모든 디렉토리 쿠키 적용
setcookie('FOO', "BAR", 0, '/');
?>
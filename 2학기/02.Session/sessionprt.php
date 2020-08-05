<?php
session_start();

// 현 세션에 저장된 세션 값 출력
echo $_SESSION['name']."<br>";
echo $_SESSION['age']."<br>";
echo $_SESSION['univ']."<br>";

// 현 세션에 ID값 출력 : 7k1bf00q9tbdjpbt1uri5pjq92
echo session_id();
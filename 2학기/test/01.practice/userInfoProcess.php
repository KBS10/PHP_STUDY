
<?php
    if(isset($_POST['user_name']) && isset($_POST['user_age'])){
        echo "{$_POST['user_name']}님 환영합니다.";
        echo "저도 {$_POST['user_age']} 입니다.";
    }else{
        echo "잘못된 접근!!";
    }


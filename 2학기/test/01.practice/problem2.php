<?php
if(isset($_POST['FromtInputNumber']) && isset($_POST['BackInputNumber'])){
    if(!empty($_POST['FromtInputNumber'])&& !empty($_POST['BackInputNumber'])){

        $PlusInputNumber = $_POST['FromtInputNumber'].$_POST['BackInputNumber'];
        $birthYear += substr($PlusInputNumber, 0, 2);
        $birthMonth = substr($PlusInputNumber, 2, 2);
        $birthDate = substr($PlusInputNumber, 4, 2);
        $genderCheck = substr($PlusInputNumber,6,1);
        $AfterBirthdayAge = 2020 - (1900 + $birthYear) + 1;
        $BeforeBirthdayAge = $AfterBirthdayAge - 2;

        // Checksum 코드의 유효성 검사
        for ($i = 0; $i < 13; $i++){
            $Array[$i] = (int) $PlusInputNumber[$i];
        }
        $multipliers = array(2,3,4,5,6,7,8,9,2,3,4,5);

        for ($i = $sum = 0; $i < 12; $i++){
            $sum += ($Array[$i] *= $multipliers[$i]);
        }

        if ((11 - ($sum % 11)) % 10 == $Array[12]){
            if($genderCheck == 1){
                echo "남자 <BR>";
                echo "생년월일 : $birthYear 년 $birthMonth 월 $birthDate 일 <BR>";
                echo "나이 : $AfterBirthdayAge 살 (만 $BeforeBirthdayAge 세)";
            }else{
                echo "여자 <BR>";
                echo "생년월일 : $birthYear 년 $birthMonth 월 $birthDate 일 <BR>";
                echo "나이 : $AfterBirthdayAge 살 (만 $BeforeBirthdayAge 세)";

            }
        }else{
            echo "잘못된 주민번호 입니다";

        }
    }else{
        echo "잘못된 접근 입니다.";
    }
}else{
    echo "잘못된 접근 입니다.";
}

?>
<?php

// $argNumOfRandNum : 발생 난수의 갯수
// $argFrom : 난수 범위 A
// $argTo : 난수 범위 B
// $argAllowDuplicatedValue : true 중복값 허용, false 중복값 허용 X
// return : 발생된 난수 값 배열

function setRandIntNum ( $argNumOfGRandNum, $argFrom, $argTo, $argAllowDuplicatedValue){
    $list = [];

    if($argAllowDuplicatedValue){
    // 중복값 허용
        for($iCount = 0; $iCount < $argNumOfGRandNum; $iCount++){
            $list = rand($argFrom, $argTo);
        }
    }else{
        // 중복값 허용 X
        for($iCount = 0; $iCount < $argNumOfGRandNum; $iCount++){
            $randNum = rand($argFrom, $argTo);
            for($jCount = 0; $jCount < $iCount; $jCount++){
                if($list[$jCount] == $randNum){
                    $randNum = rand($argFrom, $argTo);
                    --$jCount;
                }
            }// End for $jCount
            $list[$iCount] = $randNum;
        }
    }// End if-else $argAllowDuplicatedValue
    return $list;
}
// 합 구하는 함수
function sum($argList){
    return array_sum($argList);
}
// 평균 구하는 함수
function average($argList){
    return array_sum($argList) / count($argList);
}

$myList = setRandIntNum(4, 1, 10, false);
$sum    = sum($myList);
$average = average($myList);

echo "발생된 난수 값 : ";
    foreach ($myList as $value) echo $value. " ";
echo "<br>";
echo "  난수 총 합 :  $sum <br>";
echo "  난수 평균 :  $average <br>";

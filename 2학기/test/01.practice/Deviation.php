<?php
$array = array();
$result = "";
$sum = $sum2 = 0;
for($iCount = 1; $iCount <= 5; $iCount++){
    $array[$iCount] = $_POST['value'.$iCount];
    $result .= " " .$_POST['value'.$iCount];
    $sum += $_POST['value'.$iCount];
}
$avg = $sum / count($array);
for($iCount = 1; $iCount <= count($array); $iCount++){
    $sum2 += pow($array[$iCount] - $avg,2);
}

$dispersion = $sum2 / (count($array) - 1);
$standardDeviation = round(sqrt($dispersion),2);
echo    "입력 값 : " .$result ."<BR>";
echo    "평균 : " .$avg ."<BR>";
echo    "분산 : " .$dispersion ."<BR>";
echo    "표준편차 : " .$standardDeviation ."<BR>";

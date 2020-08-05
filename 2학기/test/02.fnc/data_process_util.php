<?php
// return 배열 원소의 평균 값
function average($argList){
    return sum($argList) / count($argList);
}
// return 배열 원소의 총 합
function sum($argList){
    $result = 0;
    foreach ($argList as $value){
        $result += $value;
    }
    return $result;
}

// arglsAscendingOrder : true 오름차순, false : 내림차순
// return 정렬된 배열
function sort_bubble(&$argList, $arglsAscendingOrder){
    // 오름차순
    if($arglsAscendingOrder){
        for($i = 0; $i < count($argList); $i++){
            for($j = $i + 1; $j < count($argList); $j++){
                if($argList[$i] > $argList[$j]){
                    $temp = $argList[$i];
                    $argList[$i] = $argList[$j];
                    $argList[$j] = $temp;
                }
            }
        }
    }
    // 내림차순
    else{
        for($i = 0; $i < count($argList); $i++){
            for($j = $i + 1; $j < count($argList); $j++){
                if($argList[$i] < $argList[$j]){
                    $temp = $argList[$i];
                    $argList[$i] = $argList[$j];
                    $argList[$j] = $temp;
                }
            }
        }
    }

    return $argList;
}
// return 중간 값
function median($argList){
    sort_bubble($argList,true);
    if(count($argList) % 2 == 0){
        return ($argList[count($argList) / 2] + $argList[count($argList) / 2 + 1]) / 2;
    }else{
        return $argList[count($argList) / 2];
    }
}
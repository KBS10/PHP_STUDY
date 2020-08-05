<?php
//if(3 < 2)
//    echo "1";
//    echo "2";
//
//echo"3";
//echo"4";
//
//echo"5";
//echo"6";

//-------------------------

//if(0)
//    echo 1;
//    echo 2;
//else
//    echo 3;
//    echo 4;
//echo 5;

//---------------------------

//$value = 3;
//if($value == 1)
//    echo 1;
//else if($value == 2)
//    echo 2;
//else if($value == 3)
//    echo 3;
//else if($value < 4)
//    echo 4;
//else
//    echo 5;

//--------------------------------

//$result = 0;
//for($i = 0; $i > 3; $i++){
//    $result += $i;
//}
//echo $result;

//---------------------------------

//$result = 0;
//do{
//    ++$result;
//}while($result > 5);
//echo $result;

//---------------------------------

//$result = 0;
//for($i = 2; $i < 4; $i +=2 ){
//    $result++;
//}
//
//echo $result;

//---------------------------------------

//$result = 0;
//
//for($i = 0; $i < 4; $i++ ){
//    for($j = 0; $j < 4; $j++)
//    $result++;
//}
//echo $result;

//-------------------------------------

//$result = 0;
//for($i = 0; $i < 3; $i++ ){
//    for($j = 0; $j < 3; $j++)
//    $result++;
//    if($result == 3)
//        break;
//}
//echo $result;

//---------------------------------

//$result = 2;
//
//switch($result){
//    case 1: $result ="1";
//    case 2: $result ="2";
//    case 3: $result ="3";
//    case 4: $result ="4";
//}
//echo $result;

//-----------------------------------
$value = 0;

while(true){
    $value +=2;
    if($value %4 ==0)
        break;
}

echo $value;
?>

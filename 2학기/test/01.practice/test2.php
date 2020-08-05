<?php
//// 함수 선언식 (Function declaration)
//function println($msg){
//    echo $msg."<br>";
//}
//// 함수 표현식(Function expression), 익명함수(Anonymous function)
//$print = function($msg){
//    echo $msg;
//};
//
//println("Beomsoo Kim");
//print("Richard Kim");

//-------------------------------------------------------------

//class Foo{
//    public $value = 2;
//}
//$myObj1 = new Foo();
//$value1 = 4;
//
//function changeObjValue($argObj, $argValue){
//    $argObj->value = $argValue;
//    $argValue++;
//}
//
//// $myObj1 : Call-by-reference
//// $value1 : Call-by-value
//changeObjValue($myObj1, $value1);
//
//echo $myObj1->value." : ".$value1."<br>";

//-------------------------------------------------------------

//$myArray = [10, 1, 2, 3,];
//
//function changeArrayValue($argArray, $argIndex, $argValue){
//    // $argArray는 복사된 배열 값이다.
//    $argArray[$argIndex] = $argValue;
//}
//// PHP의 함수 특징 : 배열의 경우 Call-By-Value로 전달된다.
//changeArrayValue($myArray, 0, 0);
//
//var_dump($myArray);

//-------------------------------------------------------------

//$value_1 = 1;
//
//function increment($argValue){
//    $argValue++;
//}
//
//// $value1 : Call-By-Value
//increment($value_1);
//
//echo $value_1."<br>";

//-------------------------------------------------------------

//$value_1 = 1;
//
//// $argValue 변수에 & 연산자 추가
//// $argValue 변수에 인자 값의 메모리 주소값 저장
//function increment(&$argValue){
//    $argValue++;
//}
//
//// $value1 : Call-By-reference
//increment($value_1);
//
//echo $value_1."<br>";

//-------------------------------------------------------------

//$myArray = [10, 1, 2, 3];
//
//// $argArray : Call-By-Reference
//function changeArrayValue(&$argArray, $argIndex, $argValue){
//    $argArray[$argIndex] = $argValue;
//}
//
//changeArrayValue($myArray, 0, 0);
//
//var_dump($myArray);

//-------------------------------------------------------------

//// 함수의 주소 값을 변수에 저장
//$sum = function ($argA, $argB){
//    echo "$argA + $argB = ".($argA + $argB)."<br>";
//};
//
//// 함수를 매개 변수로 전달
//function foo($argFunc){
//    //sum(2,3) 실행
//    $argFunc(2,3);
//
//    //함수를 반환 값으로 사용
//    return $argFunc;
//}
//
//$sum_d = foo($sum);
//
//// sum(2,3) 실행
//$sum_d(5,10);

//-------------------------------------------------------------'

//$println = function($argMsg){echo $argMsg."<br>";};
//
//function foo ($argFunc, $argA, $argB){
//    global $println;
//    $println($argFunc($argA, $argB));
//}
//foo(
//    // 익명함수 선언 후 foo 함수 매개변수로 전달
//function ($argA, $argB){
//    return $argA + $argB;
//},2,3);
//-------------------------------------------------------------

//// Function hoisting 지원
//foo();
//
//function foo(){
//    echo "hello<br>";
//}
//
//// 주의!! 변수는 Hoisting을 지원하지 않는다.
//
//echo $value; //Warning! Undefined variable
//
//$value = 3;

//-------------------------------------------------------------

//function foo($argA){
//    echo $argA;
//}
//
//// Fatal error: Cannot redeclare foo()
//function foo($argA, $argB){
//    echo $argA.":".$argB;
//}
//
//foo("Youngchul");
//foo("Youngchul", "Jung");

//-------------------------------------------------------------

//function sum(){
//    $argNum = func_num_args(); // 현 실행 함수의 매개변수 갯수 반환
//    echo "매개변수 갯수 : ".$argNum."<br>";
//
//    $argList = func_get_args(); // 현 실행 함수의 매개변수를 배열로 반환
//    $result = 0;
//    foreach($argList as $value) $result += $value;
//
//    return $result;
//}
//
//$result_1 = sum(1,2);
//$result_2 = sum(1,2,3);
//$result_3 = sum(1,2,3,4);
//
//echo $result_1 ."<br>";
//echo $result_2 ."<br>";
//echo $result_3 ."<br>";

//-------------------------------------------------------------

//bar(); // Error
//foo(); // 1
//
//// foo() 함수 실행 시 bar 함수가 정의 되고,
//// 함수는 정의 시 전역 Scope으로 올라가게 된다.
//bar(); // 2
//
//function foo(){
//    $foo_value = 1;
//    echo $foo_value;
//
//    function bar(){
//        // 함수 내의 접근 가능한 변수는 함수 내 선언 된 변수만 가능
//        // 고찰 : global, GLOBAL 키워드의 사용 이유를 생각해볼 것!!
//        // echo $foo_value."<br>"; // Unvisible
//        $bar_value = 2;
//        echo $bar_value;
//    }
//}

//-------------------------------------------------------------

//function foo(){
//    echo "Hello YC Jung, You are doing great job!";
//}
//
//$func_name = "foo";
//
//// 변수에 () 연산자가 붙을 경우, 해당 변수명을 가지는 함수를 실행한다.
//$func_name();
//
//class Bar{
//    function prtSomething(){
//        echo "Hello Richard Jung";
//    }
//}
//
//$obj = new Bar();
//// 객체 메서드에도 적용가능
//$method_name = "prtSomething";
//$obj->$method_name();

//-------------------------------------------------------------

$y = 1;

$fn1 = fn($x) => $x + $y;
// equivalent tousing $y by value;
$fn2 = function ($x) use ($y){
    return $x + $y;
};

var_export($fn1(3));
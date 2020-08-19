<?php
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

//class PException extends Exception{
//
//}
//class ExceptionTest{
//    public function ThrowException(){
//        try{
//            throw new PException();
//        }catch (PException $e){
//            throw $e;
//        }catch (Exception $e){
//            echo "Exception <br>";
//        }finally{
//            echo "Finally <br>";
//        }
//    }
//}
//$Obj = new ExceptionTest();
//$Obj->ThrowException();

//// Built-ini Object -> Exception
//class DBException extends  Exception{
//
//}
//class PostExceptioin extends Exception{
//
//}
//class A{
//    function test(){
//        try{
//            //해피 시나리오
//            // 예외 발생 유무 판별 식
//            // 예) POST 값을 받는데... 수신되지 않은 값이 있는지 없는지?
//            // if() throw new Exception()
//            if(true){
//                throw new PostExceptioin();
//            }
//            echo "1";
//        }catch(DBException $e){
//            // 현 예외가 발생 했을 때 처리해야 되는 구문
//            // 에러메시지 출력 후 , 번역 중지
//        }catch(PostExceptioin $e){
//            // 경고 메시지 출력 후, 이전 페이지 복귀
//            echo "2";
//            throw $e;
//            echo "2.5";
//        }finally{
//            echo "3";
//        }
//        echo "4";
//    }
//}
//$obj = new A;
//$obj->test();

//class MyCustomException extends Exception{}
//
//function doStuff(){
//    try{
//        throw new InvalidArgumentException("You are doing it wrong!", 112);
//    }catch(Exception $e){
//        throw new MyCustomException("Something happened", 911, $e);
//    }
//}
//
//try{
//    doStuff();
//}catch (Exception $e){
//    do{
//        printf(" %s:%d %s (%d) [%s]<br>", $e->getFile(), $e->getLine(), $e->getMessage()
//        , $e->getCode(), get_class($e));
//    }while($e = $e->getPrevious());
//}

////////////////////////////////////////////////////////////

// 객체 직렬화
// 메모리 상의 객체 정보를 저장하기 위해서 사용

//class Test{
//    private $i_v_1 = "variable 1";
//    private $i_v_2 = "";
//    function printAllVariable(){
//        echo $this->i_v_1.":".$this->i_v_2."<br>";
//    }
//    function setVariable2($argValue){
//        $this->i_v_2 = $argValue;
//    }
//}
//$Obj = new Test();
//$Obj -> setVariable2("OpaOpa~~~");
//echo serialize($Obj); // 객체의 정보를 문자열로 변환
//
//$byteStream = serialize($Obj);
//$unserializedObj = unserialize($byteStream);
//
//echo "<br><br> ----After unserializing ----<br><br>";
//$unserializedObj->printAllVariable();

////////////////////////////////////////////////////////////

// Object cloning(객체 복제)
// 객제 복사를 위한 연산자 or 키워드 제공 : clone (단항 연산자)
// 사용법 : clone 복사 대상 객체의 주소


// 1. Deep copy(깊은 복사)
// 2. Shallow copy (얕은 복사)
// 논점 :
// a) Primitive type 은 깊은 복사, 얕은 복사 동일하게 동작(Don't care about it )
// b) Reference type 은 깊은 복사, 얕은 복사에 따라 동작 절차 상이
// 객체가 주소되는게 얕은복사, 새로운 배열이 복사되는게 깊은 복사
// 특정 멤버변수의 경우 Deep copy처럼 동작하게 만들고 싶다.
//class A{
//    public $value = 2;
//    public $myList = array(5,4,3); // myList는 배열의 주소 값[0] 저장
//}
//$obj1 = new A();
//
//$obj2 = clone $obj1; // 깊은 복사로 구현이 된다.
//$obj1 -> myList[0] = 10;
//echo $obj2 -> myList[0];

//class B{
//    public $bar = "foo";
//}
//class A{
//    public $value = 2;
//    public $myObj;
//    function setObj($argObj){
//        $this->myObj = $argObj;
//    }
//    function __clone(){
//        $this->myObj = clone $this->myObj;
//    }
//}
//$obj1 = new A();
//$obj1->setObj(new B());
//$obj2 = clone $obj1;
//
//// 얕은(Shallow) 복사로 구현이 된다.
//// 복사 대상은 ? 객체의 멤버변수(property : 속성)
//// Scalar (Primitive) 값은 그냥 원 값이 복사 된다.
//// Reference 값은 주소 값이 복사 된다.
//$obj1->myObj->bar = "ycjung";
//echo $obj2 ->myObj-> bar; // "ycjung" 왜 얕은 복사, 멤버 변수가 참조 변수인 경우 주소값만 복사된다.

//class B{
//    public $myValue;
//    function setValue($value){
//        $this->myValue = $value;
//    }
//}
//class A{
//    public $myObj;
//    function setObj($argObj){
//        $this->myObj = $argObj;
//    }
//}
//$obj1 = new A();
//$obj1->setObj(new b());
//$obj1->myObj->setValue(13);
//
//$obj2 = deepClone($obj1);
//
//$obj1->myObj->myValue = 20;
//echo $obj2->myObj->myValue;
//function deepClone($obj){
//    return unserialize(serialize($obj));
//}

// clone과 연관된 매직메서드가 존재 합니다.
// function __clone(){
// }

//class Bar{
//    public $value = 2;
//
//    function __clone(){
//        echo "Magic method is invoked<br>";
//    }
//}
//$obj1 = new Bar;
//$obj2 = clone $obj1;
//
//echo $obj2->value."<br>";


//class A{
//    public $ma = 10;
//    public $mb = 20;
//
//    function __clone(){
//        echo "__clone() is invoked <br>";
//    }
//    function setMB($argValue){
//        $this->mb = $argValue;
//    }
//}
//
//$obj = new A();
//$obj->setMB(18);
//
//$objClone = clone $obj;
//
//echo "MB value of the cloned object : ".$objClone ->mb;

//class A{
//    static $cloned_count;
//    function __clone(){
//        echo "__clone() is invoked <br>";
//        A::$cloned_count++;
//    }
//    function __construct(){
//        echo A::$cloned_count."<br>";
//    }
//}
//$obj = new A();
//for($iCount = 0; $iCount < 5; $iCount++){
//    $cobj[$iCount] = clone $obj;
//}
//
//echo A::$cloned_count;

////////////////////////////////////////////////////////////

//Object comparison
// Comparison operator ==, ===
// 이항 연산자, 좌항 우항의 값이 같을 경우 true, 아니면 false;
// 좌항과 우항의 값이 객체인 경우???
// == 연산자와 === 연산자는 다르게 동작한다.
// 일단 제외 해야 되는 경우 서로 다른 클래스의 객체다 ==, === 둘 다 false;

//class A{
//    public $variable;
//
//    function __construct($argValue){
//        $this->variable = $argValue;
//    }
//}
//$obj1 = new A(18);
//$obj2 = new A(218);
//$obj3 = new A(18);
//$obj4 = $obj1;
//
//if($obj1 == $obj2){
//    echo '$obj1 == $obj2 : true <br>';
//}else{
//    echo '$obj1 == $obj2 : false <br>';
//}
//if($obj1 == $obj3){
//    echo '$obj1 == $obj3 : true <br>';
//}else{
//    echo '$obj1 == $obj3 : false <br>';
//}
//if($obj1 === $obj3){
//    echo '$obj1 === $obj3 : true <br>';
//}else{
//    echo '$obj1 === $obj3 : false <br>';
//}
//if($obj1 === $obj4){
//    echo '$obj1 === $obj4 : true <br>';
//}else{
//    echo '$obj1 === $obj4 : false <br>';
//}

////////////////////////////////////////////////////////////

// Object iteration

//class CYKA {
//    private $p_v = 18;
//    protected $pt_v = 218;
//    public $pb_v = 21818;
//
//    public function test(){
//        echo "test() is invoked";
//    }
//}
//
//$obj = new test();
//foreach($obj as $key => $value){
//    echo "{$key} => {$value} <br> ";
//}


//class CYKA {
//    private $p_v = 18;
//    protected $pt_v = 218;
//    public $pb_v = 21818;
//
//    public function test(){
//        foreach($this as $key => $value){
//        echo "{$key} => {$value} <br> ";
//    }
//    }
//}
//$obj = new teset();
//$obj -> test();



////////////////////////////////////////////////////////////













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
//$obj1->myObj->bar = "ycjung";
//echo $obj2 ->myObj-> bar; // "ycjung" 왜 얕은 복사, 멤버 변수가 참조 변수인 경우 주소값만 복사된다.

// 얕은(Shallow) 복사로 구현이 된다.
// 복사 대상은 ? 객체의 멤버변수(property : 속성)
// Scalar (Primitive) 값은 그냥 원 값이 복사 된다.
// Reference 값은 주소 값이 복사 된다.

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
// 프로그래밍언어에서 의미하는 것?
// 객체 내 멤버를 순회하면서 값을 출력 한다.
// -> 값: 멤버의 이름과 멤버가 가지는 값
// -> 멤버 변수를 의미한다.
// 객체 내에 있는 멤버 변수를 순회하면서 변수 이름과 값을 가지고 온다.

// 객체 내 멤버변수 값 획득에 대한 자동화(반복문 이용) 작업이 필요할 때 유용하게 사용 할 수 있다.
// for v foreach
// for : 순회, 시작과 끝을 프로그래머가 지정
// foreach : 순회, 미리 지정된 약속에 의해 시작과 반복을 수행한다.(즉, 프로그래머가 반복의 시작과 끝을 지정해줄 필요가 없다.)

//$myArray = array(5, 4, 3);
//for($i = 0; $i <count($myArray); $i++){
//    echo $myArray[$i]."<br>";
//}
//foreach($myArray as $key => $value){
//    echo $value."<br>";
//}

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
//$obj = new CYKA();
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
//$obj = new CYKA();
//$obj -> test();

////////////////////////////////////////////////////////////

// PHP에서 Array(배열) 관련 제공 함수 중, 배열의 키(key) 값에 해당하는 원소 값을 획득하는 기능을 제공하는 함수에 대해 알아보자.
// c나 Java 는 같은 자료형을 갖은 data를 하나의 배열로 관리
// PHP 에서는 같은 자료형이 아니여도 배열에 관리 할 수 있다.
// index, 내부에 있는 값 = element
// 키 값을 변경하고, 현 키 값에 대한 원소 값을 획득을 목적으로 아래 함수를 제공

// 키 값을 변경
// 이전, 다음, 현재, 제일 끝(왼쪽,오른쪽)
// prev, next, key, reset, end
// 현 키값에 대한 원소값 획득
// current

//$myArray = array("a" => 5, "b" => 4, 35 => 3);
//echo current($myArray)          ."<br>"; // 현 키값의 원소 값 반환
//echo key($myArray)              ."<br>"; // 현 키 값 반환
////echo prev($myArray)."<br>";
//echo next($myArray)     ."<br>"; // 4
//echo prev($myArray)     ."<br>"; // 5
//echo end($myArray)      ."<br>"; // 3
//echo reset($myArray)    ."<br>"; // 5

//$my_item_array = array("samsung", "nc", "doosan", "lg");
//
//$mode = current($my_item_array);      echo "{$mode}<br>";
//$mode = key($my_item_array);          echo "{$mode}<br>";
//$mode = next($my_item_array);         echo "{$mode}<br>";
//$mode = next($my_item_array);         echo "{$mode}<br>";
//$mode = next($my_item_array);         echo "{$mode}<br>";
//$mode = prev($my_item_array);         echo "{$mode}<br>";
//
//next($my_item_array);
//
//if(($mode = next($my_item_array)) == false){
//    echo "true. end of the array<br>";
//}else{
//    echo "false <br>";
//}
//
//$mode = reset($my_item_array);        echo "{$mode}<br>";
//$mode = key($my_item_array);          echo "{$mode}<br>";
//$mode = end($my_item_array);          echo "{$mode}<br>";
//$mode = key($my_item_array);          echo "{$mode}<br>";

// lterator 를 만드는 방법? 이미 정의 되어 있다 -> 객체 내
// literation 대상은 인스턴스 멤버 변수 + public 만 가능

//class A{
//    public      $value1 = 1;
//    public      $value2 = 2;
//    protected   $value_pro = 3;
//    private     $value3_pri = 3;
//
//    function prtSomething(){
//
//    }
//}
//$obj = new A();
//foreach($obj as $key => $value){
//    echo $key.":".$value."<br>";
//}

//class A{
//    public        $value1 = 1;
//    public        $value2 = 2;
//    protected     $value_pro = 3;
//    private       $value3_pri = 3;
//
//    function prtSomething(){
//        foreach($this as $key => $value){
//            echo $key.":".$value."<br>";
//        }
//    }
//}
//
//$obj = new A();
//$obj ->prtSomething();

//class A implements Iterator{
//    public $value = array(5,4,3);
//    public function current(){
//        return current($this->value);
//    }
//    public function key(){
//        return key($this->value);
//    }
//    public function next(){
//        next($this->value);
//    }
//    public function rewind(){ // foreach에서 lterator 호출 시 단 한번만 실행.
//        // 현 키값을 처음(시작 원소)
//        reset($this->value);
//    }
//    // valid가 false일 경우 다음 껄로 넘어가지 않음
//    public function valid(){
//        // 현 키 값이 유효하면 true 아니면 false
//        $key = key($this->value);
//        return($key !== false && $key !== null);
//    }
//}
//$obj = new A;
//
//foreach($obj as $key =>$value){
//    echo $key.":".$value."<br>";
//}

// 그래서 Generator PHP 5.0부터 제공된다.

//class Student implements Iterator {
//    public $name;
//    public $id;
//    public $grades;
//
//    function __construct($argName, $argId, $argGrade){
//        $this->name = $argName;
//        $this->id = $argId;
//        $this->grades = $argGrade;
//    }
//    public function valid()
//    {
//        $key = key($this->grades);
//        return($key !== null && $key !== false);
//    }
//    public function rewind()
//    {
//        reset ($this->grades);
//    }
//    public function next()
//    {
//        next ($this->grades);
//    }
//    public function key()
//    {
//        return key($this->grades);
//    }
//    public function current()
//    {
//        return current($this->grades);
//    }
//}
//$obj = new Student("김범수","1701304",array("korean" => 100, "math" => 90, "english" => 80));
//
//foreach($obj as $key => $value){
//    echo $key." : ". $value ."<br>";
//}


// 캡쳐
//class Myliterator implements Iterator{
//    public $value;
//    public function __construct($argArray){
//        $this->value = $argArray;
//    }
//    public function current(){
//        return current($this->value);
//    }
//    public function key(){
//        return key($this->value);
//    }
//    public function next(){
//        next($this->value);
//    }
//    public function rewind(){
//        reset($this->value);
//    }
//    public function valid(){
//        $key = key($this->value);
//        return($key !== false && $key !== null);
//    }
//}
// lteratorAggregate -> 인터페이스
// literation 내용 (순회규칙)을 정형(틀)화 해서 클래스로 작성해서,
// 기존 literator 인터페이스 내 추상메서드들을 구현할 필요없이, 가져다 쓰기 위해.
//class A implements IteratorAggregate {
//    public $myList = array(10,9,8);
//    public function getIterator()
//    {
//        return new Myliterator($this->myList);
//    }
//}
//$obj = new A;
//foreach($obj as $key => $value){
//    echo $key.":".$value."<br>";
//}

// Generator -> yield(양보하다,생산하다) 키워드가 포함된 함수는 Generator 함수다.
// Generator 함수는 반드시 yield 키워드를 포함하고 있다.
//class A{
//    public $value = array("a"=>5,"b"=>4,"c"=>3);
//    function getGenerator(){
//        foreach($this->value as $key => $value){
//            yield $key => $value; // yield 키워드는 리턴과 같이 값을 반환하나. 함수가 종료된다...
//
//        }
//    }
//}
//$obj = new A();
//
//foreach ($obj->getGenerator() as $key => $value){
//    echo $key.":".$value."<br>";
//}

////////////////////////////////////////////////////////////

// Type hinting
// 메서드 내 매개변수의 자료형을 명시(강제적)

//class TypeHintingTest{
//    function test Class (test $c){
//        $c -> prt();
//}
//}
//
//class test{
//    function prt(){
//        echo "prt() in test is invoked <br>";
//    }
//}
//
//$c = new test();
//$t = new TypeHintingTest();
//$t -> test Class($c);
//$t -> test Class(1818218);

//interface testInt{
//    public function prtInt();
//}
//class test implements testInt{
//    public function prtInt(){
//        echo "prtInt() in test in invoked<br>";
//    }
//}
//class TypeHintingTest{
//    function arrayTest (array $a){
//        foreach($array as $key => $value){
//            echo "{$key} => {$value}";
//        }
//    }
//    function InterfaseTest (testInt $i){
//        $i->prtInt();
//    }
//    function callabaleTest (callable $c, $data){
//        call_user_func($c, $data);
//    }
//}
//
//$t = new TypeHintingTest();
//
//$t ->arrayTest(1);
//$t ->InterfaseTest(1818218);
//$t ->callabaleTest(1,2);

//function test($data){
//    echo $data."<br>";
//}
//$t = new TypeHintingTest();
//$obj = new test();
//
//$t->arrayTEst(array(1, 2, 3));
//$t -> InterfaceTest($obj);
//$t -> callableTest('test',2);


////////////////////////////////////////////////////////////

// Auto loading classes

//$obj1 = new test();
//$obj1 -> prt();
//
//$obj2 = new igomoya();
//$obj2 -> prt();

//function __autoload($class_name){
//    echo "$class_name<br>";
//}
//$obj1 = new test();
//$obj1 -> prt();
//
//$obj2 = new igomoya();
//$obj2 -> prt();

//class test{
//    function prt(){
//        echo "prt() in test is invoked <br>";
//    }
//}
//class igomoya{
//    function prt(){
//        echo "prt() is igomoya is invoked<br>";
//    }
//}
//function __autoload($class_name){
//    echo "$class_name<br>";
//}
//$obj1 = new test();
//$obj1 -> prt();
//
//$obj2 = new igomoya();
//$obj2 -> prt();




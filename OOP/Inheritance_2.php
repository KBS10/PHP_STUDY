<?php
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

// Scope resolution operator :: ->
// 목적 : 객체 또는 클래스의 멤버를 접근하기 위해서
// 둘 다(::, ->) 메서드는 클래스, 인스턴스 둘 다 접근 가능
// 멤버 변수 접근 시 차이점 발생
// -> : 인스턴스 멤버 변수만 접근 가능
// :: : 클래스멤버 변수만 접근 가능

// 참조하고자하는 객체 또는 클래스의 주소 :: 참조 멤버
// self, parent, 클래스 이름, static <- 좌항으로 사용되는 키워드
// 접근하고자 하는 멤버 이름 <- 우황
// -> 클래스 멤버와 인스턴스 메서드만 해당
// 인스턴스 멤버는 사용 불가능

//class A{
//    public $value = 2; // 인스턴스 멤버
//
//    function prtSomething(){
//        echo $this->value; // :: 를 이용해서 우항에 접근하는 멤버의 타입이 인스턴스?
//    }
//}
//$obj = new A();
//$obj->prtSomething();

// 상수 접근

//class MyClass{
//    const CONST_VALUE = 'A constant value';
//}
//$classname = 'MyClass';
//echo $classname::CONST_VALUE;
//echo MyClass::CONST_VALUE;
//
//class OtherClass extends MyClass{
//    public static $my_static = 'static var';
//
//    public static function doubleColon(){
//        echo parent::CONST_VALUE."<br>";
//        echo self::$my_static."<br>";
//    }
//}
//$classname = 'OtherClass';
//echo $classname::doubleColon();
//OtherClass::doubleColon();

/////////////////////////////////////////////////////////////

// 범위 해결 연산자 self:: 와 $this의 차이점
// self
// ㄴ 자기자신의 클래스를 찾아간다.
// $this
// ㄴ instance - 인스턴스의 함수나 변수를 가리킨다.

//class A{
//    public function test(){
//        echo $this->i_v."<br>";
//        echo self::c_v."<br>";
//    }
//}
//class B extends A{
//    public $i_v = "bar";
//    const c_v = "foo2";
//}
//$obj1 = new B();
//$obj1 -> test();

//class A{
//    public $i_v = "bar";
//    const c_v = "foo";
//    public function test(){
//        echo $this->i_v."<br>";
//        echo self::c_v."<br>";
//    }
//}
//class B extends A{
//    public $i_v = "bar";
//    const c_v = "foo";
//}
//$obj1 = new B();
//$obj1 -> test();

// ppt 자료 X
//class A{
//    static function prtMyName(){
//        echo __CLASS__;
//    }
//    function prtSomething(){
//        self::prtMyName();
//    }
//}
//class B extends A{
//    static function prtMyName()
//    {
//        echo __CLASS__;
//    }
//}
//$obj = new B;
//$obj->prtSomething();

//class A{
//    static function prtMyName(){
//        echo __CLASS__;
//    }
//    function prtSomething(){
//        static::prtMyName();
//    }
//}
//class B extends A{
//    static function prtMyName(){
//        echo __CLASS__;
//    }
//}
//$obj = new B();
//$obj->prtSomething();
/////////////////////////////////////////////////////////////

// 범위 해결 연산자 parent::
// 부모의 인스턴스 멤버 메서드 호출.
// - 메서드의 경우 인스턴스 메서드도 :: 연산자를 이용하여 호출 가능

//class A{
//    public $i_v = "i_v 1";
//    const c_v   = "c_v 1";
//    static $s_v = "s_v 1";
//
//    public function test(){
//        echo $this->i_v."<br>";
//        echo self::$s_v."<br>";
//    }
//}
//class B extends A{
//    public $i_v = "i_v 2";
//    const c_v   = "c_v 2";
//    static $s_v = "s_v 2";
//    function ycj(){
//        echo self::$s_v."<br>";
//        parent::test();
//    }
//}
//$b = new b();
//$b -> ycj();

/////////////////////////////////////////////////////////////

// 범위 해결 연산자 Late static binding

// ppt 자료 X

//class A{
//    private function className(){
//        echo __CLASS__."<br>";
//    }
//    public function printClass(){
//        $this->className();
//        static::className();
//    }
//}
//class B extends A{
//
//}
//class C extends A{
//    private function className(){
//
//    }
//}
//$b = new B();
//$b->printClass();
//$c = new C();
//$c->printClass();

///////////////////

//class A{
//    public $a;
//
//    function set ($argA){
//        $this -> a = $argA;
//    }
//}
//$obj = new A();
//$obj -> set(2);
//$obj -> set(2.0);
//$obj -> set("Two");

//class A{
//    function test(){
//        echo "A's test() <br>";
//    }
//    function callTest(){
//        $this->test();
//    }
//}
//class B extends A {
//    function test(){
//        echo "B's test() <br>";
//    }
//}
//$b = new B();
//$b ->callTest();

//class A{
//    static function test(){
//        echo "A's test() <br>";
//    }
//    function callTest(){
//        $this->test();
//    }
//}
//class B extends A {
//    static function test(){
//        echo "B's test() <br>";
//    }
//}
//$b = new B();
//$b ->callTest();

//class A{
//    public static function who(){
//        echo __CLASS__;
//    }
//    public static function test(){
//        self::who();
//    }
//}
//class B extends A{
//    public static function who(){
//        echo __CLASS__;
//    }
//}
//B::test();

//class A{
//    public static function who(){
//        echo __CLASS__;
//    }
//    public static function test(){
//    static::who();
//    }
//}
//class B extends A{
//    public static function who(){
//        echo __CLASS__;
//    }
//}
//B::test();

/////////////////////////////////////////////////////////////

//class A{
//    const c_v = 18;
//    public $i_v = 19;
//    static $s_v = 20;
//    function test(){
//        echo static::$s_v."<br>";
//    }
//}
//class B extends A{
//    static $s_v = 30;
//    function test(){
//        echo parent::test();
//        echo self::$s_v."<br>";
//    }
//}
//$b = new B();
//$b -> test();

/////////////////////////////////////////////////////////////

//class A{
//    function __set($name, $value){ // __set 매직 메서드를 오버라이딩
//        echo "모르는 멤버 변수가 들어 왔어 이름은 ? : " .$name."<br>";
//        echo "값은 ? : ".$value."<br>";
//    }
//    function __get($name){
//        echo "모르는 멤버 변수가 들어 왔어 이름은 ? : " .$name."<br>";
//    }
//    public $myData = array();
//    function __set($name, $value){
//        $this->myData[$name] = $value;
//    }
//    function __get($name){
//        return $this->myData[$name];
//    }
//}
//$obj = new A;
//$obj -> name = "ycjung";
//echo $obj->name;

// Overloading(1)

//class OverloadingTest{
//    function test(){
//        echo "test () is invoked <br>";
//    }
//    function test($arg1, $arg2){
//        echo " test({$arg1}, {$arg2}) is invoked <br>";
//    }
//}
//$obj = new OverloadingTest();
//
//$obj -> test();
//$obj -> test(1, 2);

// Overloading(2)
// & 연산자 -> 주소값을 가져옴.

//class OverloadingTest{
//
//}
//$obj = new OverloadingTest();
//$obj -> test = 18;
//$var_a = $obj ->opnet;

// Overloading(3)

//class OverloadingTest{
//    function __set($name, $arg){
//        print $name .":" . $arg . "<br>";
//    }
//    function __get($name){
//        print $name."<br>";
//    }
//}
//$obj = new OverloadingTest();
//$obj -> test = 18;
//
//$var_a = $obj -> opnet;

// Overloading(4)

//class OverloadingTest{
//    function __set($name, $arg){
//        print $name .":" .$arg."<br>";
//    }
//    function __get($name){
//        print $name."<br>";
//    }
//    function __isset($name){
//        print "__isset() -> " .$name."<br>";
//        return true;
//    }
//    function __unset($name){
//        print "__unset() -> " .$name."<br>";
//        return true;
//    }
//}
//$obj = new OverloadingTest();
//$obj -> test = 18;
//$var_a = $obj ->opnet;
//
//isset($obj->test);
//unset($obj->opnet);

//class Variables{
//    public function __construct(){
//        if(session_id() === ""){
//            session_start();
//        }
//    }
//    public function __set($name, $value){
//        $_SESSION ["Variables"] [$name] = $value;
//    }
//    public function &__get($name){
//        return $_SESSION ["Variables"] [$name];
//    }
//}
//$obj = new Variables();
//
//$obj->user_name = "초리";
//$obj->user_id = 1234567;

// __call -> 클래스 내 선언되어 있지 않은 인스턴스 메서드를 호출 할 때 수행

//class OverloadingTest{
//    function __call($name, $parameters){
//        echo $name."(";
//        foreach($parameters as $value) echo $value.",";
//        echo ")<br>";
//    }
//}
//$obj = new OverloadingTest();
//$obj -> test(1, "two", 3.0);

//class OverloadingTest{
//    static function __callstatic($name, $parameters){
//        echo $name."(";
//        foreach($parameters as $value) echo $value.",";
//        echo ")<br>";
//    }
//}
//OverloadingTest::test(1, "two", 3.0);

//class OverloadingTest{
//    function __call($name, $parameters){
//        switch($name){
//            case 'test':
//                $num_of_parameters = count($parameters);
//                if($num_of_parameters == 0){
//                    $this->test_0();
//                }else if($num_of_parameters == 2){
//                    $this -> test_2($parameters[0], $parameters[1]);
//                    break;
//                }
//                default:
//                break;
//        }
//    }
//    function test_0(){
//        echo "test() is invoked <br>";
//    }
//    function test_2($arg1, $arg2){
//        echo "test({$arg1}, {$arg2}) is invoked <br>";
//    }
//}
//
//$obj = new OverloadingTest();
//$obj ->test();
//$obj ->test(1,2);

/////////////////////////////////////////////////////////////

//$a = 2;
//$b = &$a;
//$b = 3;
//echo $a."<br>";
//echo $b."<br>";

//class A {
//    public $value = 2;
//}
//
//$obj1 = new A;
//$obj2 = $obj1;
//
//$obj2->value =3;
//echo $obj1->value;


//적용 파트 두 가지
// 1) 함수 또는 메서드의 매개변수
// 2) 함수 또는 메서드의 반환값

//function inc(&$a){
//    $a++;
//    echo $a;
//}
//$value = 3;
//inc($value);
//echo $value;

// &$a -> call_by_reference
// $b -> call_by_value

//class A{
//    function inc(&$a, $b) {
//        $a++;
//        $b++;
//    }
//}
//$valueA = 2;
//$valueB = 3;
//$value1 = new A();
//$value1->inc($valueA, $valueB);
//
//echo $valueA.":".$valueB;

//class A{
//    public $value = 2;
//
//    function &test(){
//        return $this->value;
//    }
//}
//$obj = new A;
//$myValue = &$obj ->test();
//
//$myValue = 3;
//
//echo $obj->value;

//function &test(){
//    static $a = 2;
//    return $a;
//}
//$b = &test();
//
//$b = 5;
//echo test();


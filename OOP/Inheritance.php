<?php
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

// 상속에 대한 내용

//class A{
//    public $name;
//
//    public function __construct($argName){
//        $this->name = $argName;
//    }
//    public function prtName(){
//        echo $this->name;
//    }
//}
//class B extends A{
//    public $age;
//
//    public function __construct($argName, $argAge){
//        parent::__construct($argName);
//        $this->age = $argAge;
//    }
//    public function prtInfo(){
//        echo $this->name;
//        echo $this->age;
//    }
//}
//$obj = new B("김범수", 23);
//$obj -> prtInfo();

/////////////////////////////////////////////////////////////

//스크립트와 컴파일러 언어의 차이

//class A{
//    function prtSomething(){
//        echo $this->test;
//    }
//}
//class B extends A{
//    public $test = 3;
//}
//$obj1 = new B();
//$obj1->prtSomething();

/////////////////////////////////////////////////////////////

// 상속 선언 방법

//class A{
//    protected $name = "김범수";
//    public function printName(){
//        echo $this->name."<br>";
//    }
//}
//class B extends A{
//    protected $age = 23;
//    public function printAge(){
//        echo $this->age."<br>";
//    }
//    public function printInfo(){
//        $this->printName();
//        $this->printAge();
//    }
//}
//$objA = new B();
//$objA -> printInfo();

/////////////////////////////////////////////////////////////

//상속 생성자와 소멸자
// 상속 시 상위클래스의 생성자, 소멸자는 호출되지 않는다.

//class A{
//    function __construct(){
//        echo "A's constructor is invoked.<br>";
//    }
//    function __destruct(){
//        echo "A's destructor is invoked.<br>";
//    }
//}
//class B extends A{
//    function __construct(){
//        echo "B's constructor is invoked.<br>";
//    }
////    function __destruct(){
////        echo "B's destructor is invoked.<br>";
////    }
//}
//class C extends B{
//    function __construct(){
//        echo "C's constructor is invoked.<br>";
//    }
////    function __destruct(){
////        echo "C's destructor is invoked.<br>";
////    }
//}
//$objA = new C();

/////////////////////////////////////////////////////////////

// 상속 오버라이딩
// 오버라이딩을 할 시 자식의 접근 제어자는 부모의 접근 제어자보다 같거나 커야한다.

//class A{
//    function printMyName(){
//        echo __CLASS__."<br>";
//    }
//}
//class B extends A{
//    function printMyName(){
//        echo __CLASS__."<br>";
//    }
//}
//class C extends A{
//    protected function printMyName(){
//        echo __CLASS__."<br>";
//    }
//}
//
//$objB = new B();
//$objB -> printMyName();
//
//$objC = new C();
//$objC -> printMyName();

/////////////////////////////////////////////////////////////

// 상속 접근 제어자(1)
// 1. 참조변수를 이용해서 객체를 접근할 때, 참조변수가 접근할 수 있는 멤버를 구분하기 위해서
// 2. 상속 시, 부모입장에서 자손 클래스에게 물려줄 멤버를 결정 하기 위해서
// public       : 모두 접근 가능
// protected    : 같은클래스, 자손 클래스 접근 가능
// private      : 같은 클래스 만 접근 가능

//class A{
//    private $privateValue = 30;
//    protected  $protectedValue = 21;
//    public $publicValue = 32;
//}
//class B extends A{
//    function test(){
//        echo $this->protectedValue."<br>";
//    }
//}
//$objA = new A();
//$objB = new B();
//
//echo $objA->privateValue."<br>";
//echo $objA->protectedValue."<br>";
//echo $objA->publicValue."<br>";
//
//echo $objB->privateValue."<br>";
//echo $objB->protectedValue."<br>";
//echo $objB->publicValue."<br>";

/////////////////////////////////////////////////////////////

// 상속 접근 제어자(2)
// 싱글 톤 디자인(소프트 웨어 디자인 패턴)
// 특정클래스의 객체를 한개만 만들 수 있는 디자인 패턴

//class A {
//    static $ObjRef = null;
//    private function __construct(){
//        echo "A's constructor is invoked<br>";
//    }
//    // 아래 클래스 메서드 호출시 A 클래스의 객체 반환
//    static function getObject(){
//        // A 클래스의 객체를 반환하는 프로그램 작성
//        // 단, A 클래스 객체는 단 한개 만 존재
//        // 언제 A 클래스의 객체를 생성 할까? -> 현재 A클래스의 객체가 한 개도 생성되지 않았을 때!
//        if(self::$ObjRef == null){
//            self::$ObjRef = new A();
//        }
//        return self::$ObjRef;
//    }
//    function printMyName(){
//        echo __METHOD__."<br>";
//    }
//}
//// new A(); -> new 연산자를 이용해서 객체를 생성 할 수 없다.
//$objA = A::getObject();
//$objA-> printMyName();

/////////////////////////////////////////////////////////////

// 상속 접근 제어자(3)

//class A{
//    private     $privateValueA      = "A18";
//    protected   $protectedValueA    = "A218";
//    public      $publicValueA       = "A21818";
//
//    public function AMTest(A $argA, B $argB){
//        echo $argA->privateValueA."<br>";
//        echo $argA->protectedValueA."<br>";
//        echo $argA->publicValueA."<br>";
//        echo $argB->privateValueB."<br>";
//        echo $argB->protectedValueB."<br>";
//        echo $argB->publicValueB."<br>";
//    }
//}
//class B{
//    private     $privateValueB      = "B18";
//    protected   $protectedValueB    = "B218";
//    public      $publicValueB       = "B21818";
//}
//$objA1  = new A();
//$objA2  = new A();
//$objB   = new B();
//$objA1 ->AMTest($objA2, $objB);

/////////////////////////////////////////////////////////////

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

//class A{
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

/////////////////////////////////////////////////////////////

// 범위 해결 연산자 parent::

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

//class A{
//    public $a;
//
//    function set ($argA){
//        $this -> $a = argA;
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














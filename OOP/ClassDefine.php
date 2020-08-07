<?php

////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

// 클래스 정의 및 객체 생성 예제

//class MyFirstClass{
//    // 멤버변수(속성: property) 선언
//    private $name;
//    // 생성자 선언
//    function __construct($argName){
//        // 현 객체의 인스턴스 멤버를 접근
//        $this->name = $argName;
//    }
//    // 메소드 선언
//    function printMyName(){
//        echo $this->name;
//    }
//}
//// MyFirstClass의 객체 생성
//$mfc = new MyFirstClass("김범수");
//// 생성된 객체의 "printMyName" 메소드 호출
//$mfc->printMyName();

/////////////////////////////////////////////////////////////////////

// 생성자 정의 방법

//class BaseClass{
//    function __construct(){
//        print "In BaseClass constructor\n"."<BR>";
//    }
//}
//$obj = new BaseClass();

/////////////////////////////////////////////////////////////////////

// 생성자(Constructor)(1)

//class ClassA{
////    function __construct(){
////        print "Class A's constructor is invoked"."<br>";
////    }
//    function ClassA(){
//        print "ClassA() is used as a constructor"."<br>";
//    }
//}
//$obj = new ClassA();

/////////////////////////////////////////////////////////////////////

// 생성자(Constructor)(2)

//class ClassA{
//    function __construct(){
//        print "Class A's constructor is invoked"."<br>";
//    }
//}
//class ClassB extends ClassA{
//function __construct(){
//        print "Class B's constructor is invoked"."<BR>";
//    }
//}
//$obj = new ClassB();

/////////////////////////////////////////////////////////////////////

// 생성자(Constructor)(3)

//class ClassB extends ClassA{
//    function __construct(){
//        print "Class B's constructor is invoked"."<BR>";
//    }
//}
//$obj = new ClassB();

/////////////////////////////////////////////////////////////////////

// 생성자(Constructor)(4)

//class ClassA{
//    function __construct(){
//        print "Class A's constructor is invoked"."<br>";
//    }
//}
//
//class ClassB extends ClassA{
//    function __construct(){
//        parent::__construct();
//        print "Class B's constructor is invoked"."<BR>";
//    }
//}
//$obj = new ClassB();

/////////////////////////////////////////////////////////////////////

// 소멸자(Destructor)(1)

//class ClassA{
//    function __construct(){
//        print "Class A's constructor is invoked"."<br>";
//    }
//    function __destruct(){
//        print "Class A's destructor is invoked"."<br>";
//    }
//}
//
//$obj = new classA();
//echo "Before destroying<br>";
//unset($obj);
//echo "After destroying<br>";

/////////////////////////////////////////////////////////////////////

// 속성(property)(1)

//class PClass{
//    private $name;
//    private $age;
//    function __construct($name, $age){
//        echo "PClass constructor is invoked<br>";
//        $name = $name;
//        $age = $age;
//    }
//    function printMyName(){
//            echo "My name : ". $this->$name."<br>";
//    }
//    function printMyAge(){
//            echo "My age : ". $this->$age."<br>";
//    }
//    function printMyInfo(){
//            $this->printMyName();
//            $this->printMyAge();
//    }
//}
//$obj = new PClass("김범수", 23);
//$obj -> printMyInfo();

/////////////////////////////////////////////////////////////////////

// 상수(constant)(1)

//class MyClass{
//    const CONSTANT = 'constant value';
//
//    function showConstant(){
//        echo self::CONSTANT."<br>";
//    }
//}
//echo MyClass::CONSTANT. "<br>";
//$classname = "MyClass";
//echo $classname::CONSTANT. "<br>";
//
//$class = new MyClass();
//$class -> showConstant();
//
//echo $class::CONSTANT."<br>";

/////////////////////////////////////////////////////////////////////

// 메소드(method)(3)

//class A{
//    public static $MyName = "멋쟁이 초리~";
//    private       $MyAge = "23";
//
//    static public function printMyName(){
//        echo self::$MyName."<br>";
//    }
//
//    public function printMyAge(){
//        echo $this->MyAge."<br>";
//    }
//}
//
//A::printMyName();
//$objB = new A();
//$objB ->printMyAge();

/////////////////////////////////////////////////////////////////////

// 인스턴스 vs 클래스 (1)

//class CM{
//    private static $classValue = "class member value";
//    private         $memberValue = "instance member value";
//
//    public static function printClassValue(){
//        echo CM::$classValue."<br>";
//    }
//
//    public function printMemberValue(){
//        echo $this->memberValue."<br>";
//    }
//}
//
//CM::printClassValue();
//
//$objA = new CM();
//$objA->printMemberValue();

/////////////////////////////////////////////////////////////////////

// 인스턴스 vs 클래스 (2)

//class CI{
//    private static $classValue = 1;
//    public static function printClassName(){
//        echo __CLASS__."<br>";
//    }
//    public function printClassValue(){
//        echo CI::$classValue."<br>";
//    }
//    public function increaseClassValue(){
//        CI::$classValue++;
//    }
//}
//CI::printClassName();
//
//$objA = new CI();
//$objB = new CI();
//
//$objA->increaseClassValue();
//$objB->printClassValue();

/////////////////////////////////////////////////////////////////////

// 인스턴스 vs 클래스 (3)

//class CIR{
//    private static $age = 23;
//    private static $name = "김범수";
//
//    public static function printName(){
//        echo CIR::$name."<br>";
//    }
//    public static function printAge(){
//        echo CIR::$age."<br>";
//    }
//    public static function printInfo(){
//        CIR::printName();
//        CIR::printAge();
//    }
//}
//CIR::printInfo();
//
//$obj = new CIR();
//$obj->printInfo();




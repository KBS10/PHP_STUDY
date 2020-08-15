<?php
////////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
////////////////////////////////////////////////////////////

// abstract : 미완성의
// 자식클래스에서 반드시 구현을 해야 할 경우에 사용
// 객체를 못찍게 하기 위해서 abstract 를 사용하는 경우 도 있다.

// PHP 다형성이 없는 이유
// 타입 저글링때문에
// Java에서 다형성을 사용하는 이유
// - 서로 다른 자료형을 가진 자료형을 하나의 자료형으로 나타내기 위해서

//abstract class AbstractClass{
//    abstract protected function getValue();
//    abstract protected function prefixValue($prefix);
//
//    public function printOut(){
//        print $this->getValue()."<br>";
//    }
//}

///////////////////////////////////////////////////////////

//class ConcreteClass extends AbstractClass{
//    protected function getValue()
//    {
//        return "ConcreteClass";
//    }
//    public function prefixValue($prefix)
//    {
//        return "{$prefix} ConcreteClass";
//    }
//}
//
//$obj = new ConcreteClass();
//echo $obj->printOut()."<br>";
//echo $obj->prefixValue("test")."<br>";

/////////////////////////////////////////////////////////

//abstract class A{
//    abstract function getValue();
//}
//abstract class B extends A{
//
//}
//class C extends B{
//    function getValue(){
//        echo "print GV";
//    }
//}
//$Obj = new C();
//$Obj -> getValue();

/////////////////////////////////////////////////////////

//interface
// 일종의 추상클래스 -> 추상클래스보다 추상화 정도가 높다.
// 시스템을 개발 할 때, A,B 각각의 회사에 교집합이 되는 부분을 동시에 작업을 할 때,
// 효율적으로 나타내기 위해서
// 추상메서드와 상수만을 멤버로 가질 수 있다.
// 인스턴스를 생성할 수 없고, 클래스 작성에 도움을 준 목적으로 사용된다.
// 인터페이스 간 상속이 가능 -> 다중 상속 가능


//interface engine{
//    const cylinder_num = 4;
//    public function go();
//    public function stop();
//}
////
//class BenzEngine implements engine{
//    public function go(){
//        echo "BenzEngine start<br>";
//    }
//    public function stop(){
//        echo "BenzEngine stop<br>";
//    }
//}
////
//class NissanQ50{
//    private $engine;
//    function __construct($argEngine){
//        $this ->engine = $argEngine;
//    }
//    function go(){$this->engine->go();}
//    function stop(){$this->engine->stop();}
//}
//
//$engine = new BenzEngine();
//$q50 = new NissanQ50($engine);
//$q50 -> go();
//$q50 -> stop();

/////////////////////////////////////////////////////////

//interface Red{
//    public function printRed();
//}
//interface Green{
//    public function printGreen();
//}
//interface Blue{
//    public function printBlue();
//}
//interface Color extends Red, Green, Blue{
//    public function printColor();
//}
//interface Black{
//    public function printBlack();
//}
//class Printer implements Color, Black{
//    public function printRed(){
//        echo "빨간색 출력!!<br>";
//    }
//    public function printGreen(){
//        echo "녹색 출력!!<br>";
//    }
//    public function printBlue(){
//        echo "파랑색 출력!!<br>";
//    }
//    public function printColor(){
//        echo "<br> --컬러모드 출력--<br>";
//        $this->printRed();
//        $this->printGreen();
//        $this->printBlue();
//    }
//    public function printBlack(){
//        echo "<br>--흑백모드 출력--<br>";
//        echo "검정색 출력!!";
//    }
//}
//$InkJetColorPrinter = new Printer();
//$InkJetColorPrinter -> printColor();
//$InkJetColorPrinter -> printBlack();

//interface A{
//    // 추상메소드, 상수
//    // 같인이름을 가진 메서드는 ok, 하지만 같은명을 가진 상수는 X
//
//    const VALUE = 2;
//    function prtSome();
//}
//
//interface B{
//
//    const VALUE = 2;
//    function prtSome();
//}
//
//interface C extends A, B{
//
//}
/////////////////////////////////////////////////////////

// 다중 상속의 단점 : 다이아몬드 문제(각 부모마다 정해놓은 상수와 메소드, 변수가 중복이 되기 때문에)
// 다중 상속을 사용하는 이유
// - 소스코드재사용률을 극대화 할 수 있다.

// Traits
// 소스코드의 재 사용률을 높이기 위한 방안
// 다른 클래스 계층 구조에 있는 여러 독립 클래스에서 메서드 집합을 자유롭게 할수 있도록
// 단일 상속의 일부 제한을 줄이기 위한 것
// 기본 클래스에서 상속 된 멤버는 Trait에 의해 삽입된 멤버에 의해 재정의
// 여러 특성을 쉼표로 구분하여 use 문에 나열하여 클래스에 삽입

// 동일한 클래스에서 사용되는 Traits간의 이름 충돌을 해결하려면, 충돌하는 메서드 중 정확히 하나를 선택
// insteadof 연산자를 사용

// trait의 타켓은 메서드 : 클래스 인스턴스 + 추상메서드

// Trait : 소스코드의 재사용률을 높인다.


//trait IGoMoYa{
//    private $this = "test i-variable";
//
//    function __construct(){
//        echo "IGoMoYa's constructor is invoked!! <br>";
//    }
//    function __destruct(){
//        echo "IGoMoYa's destructor is invoked!! <br>";
//    }
//    function test(){
//        echo "IGoMoYa's test() is invoked!! <br>";
//    }
//}
//class Main{
//    use IGoMoYa;
//}
//echo "It's show time!! <br>";
//$obj = new Main;
//$obj ->test();

/////////////////////////////////////////////////////////

//trait Arms{
//    private $itemL = "[trait:Arm] 왼손";
//    private $itemR = "[trait:Arm] 오른손";
//    private $itemT = "[trait:Arm] 무장";
//
//    function prtArms(){
//        echo $this->itemL.":";
//        echo $this->itemR."<br>";
//    }
//}
//trait HF{
//    private $itemH = "[trait:HF] 머리";
//    private $itemF = "[trait:HF] 다리";
//    function prtHead(){
//        echo $this->itemH."<br>";
//    }
//    function prtFoot(){
//        echo $this->itemF."<br>";
//    }
//}
//trait tbody{
//    function prtBody(){
//        echo "[trait: body] : 몸체<br>";
//    }
//}
//class cbody{
//    function prtBody(){
//        echo "[class: body]: 몸체<br>";
//    }
//}
//class Gundam extends cbody{
//    use HF,ARms,tbody;
//    function printAll(){
//        $this->prtFoot();
//        $this->prtArms();
//        $this->prtHead();
//
//        echo "무장" . $this->itemT."<br>";
//    }
//}
//$obj = new Gundam();
//$obj -> printAll();

/////////////////////////////////////////////////////////

// Modifier 제어자
// 접근제어자와 그 외

// 그 외 : static, final
// final : 변수(상수), 메서드(오버 라이딩 금지), 클래스(상속 금지)

//trait A{
//    function prtValue(){
//        echo "A's trait invoked <br>";
//    }
//}
//trait B{
//    function prtValue(){
//        echo "B's trait invoked <br>";
//    }
//}
//trait C{
//    function prtValue(){
//        echo "C's trait invoked <br>";
//    }
//}
//class AClass{
//    use A, B, C{
//        A::prtValue insteadof B, C;
//    }
//}
//class BClass extends AClass{
//
//}
//$Obj = new BClass();
//$Obj ->prtValue();

//trait TraitTest{
//    function test1(){
//        echo "[trait: test()1]<br>";
//    }
//    function test2(){
//        echo "[trait: test()2]<br>";
//    }
//}
//class base{
//    function test2(){
//        echo "[base class: test()2]<br>";
//    }
//}
//class Main{
//    use TraitTest;
//    function test1(){
//        echo "[Main Class: test()2]<br>";
//    }
//}
//$obj = new Main();
//$obj ->test1();
//$obj ->test2();

/////////////////////////////////////////////////////////

//trait A{
//    public function smallTalk(){
//        echo 'a';
//    }
//    public function bigTalk(){
//        echo 'A';
//    }
//}
//trait B{
//    public function smallTalk(){
//        echo 'b';
//    }
//    public function bigTalk(){
//        echo 'B';
//    }
//}
//class Talker{
//    use A, B;
//}
//$obj = new Talker();
//$obj -> smallTalk();
//$obj -> bigTalk();

/////////////////////////////////////////////////////////

//class Talker{
//    use A, B{
//        A::smallTalk insteadof B;
//        B::bigTalk insteadof A;
//    }
//}
//$obj = new Talker();
//$obj -> smallTalk();
//$obj -> bigTalk();

/////////////////////////////////////////////////////////

//trait A{
//    // private $pv = 1818;
//    private function test1(){
//        echo "A::test1()";
//    }
//    private function test2(){
//        echo "A::test2()";
//    }
//}
//class Main{
//    use A{
//        // pv as public;
//        test1 as public;
//        test2 as public;
//    }
//}
//
//$obj = new Main();
//$obj->test1();
//$obj->test2();
//echo $obj->pv."<br>";

/////////////////////////////////////////////////////////

//trait Hello{
//    public function sayHelloWorld(){
//        echo 'Hello'.$this->getWorld();
//    }
//    abstract public function getWorld();
//}
//class MyHelloWorld{
//    private $world;
//    use Hello;
//    public function getWorld(){
//        return $this->world;
//    }
//    public function setWorld($val){
//        $this->world = $val;
//    }
//}
//$obj = new MyHelloWorld();
//$obj->setWorld("bar");
//$obj->sayHelloWorld();

//trait PropertiesTrait{
//    public $same = true;
//    public $different = false;
//    private $test = 18;
//}
//class PropertiesExample{
//    use PropertiesTrait;
//    public $same = true;
//    public $different = true;
//    private $test = 18;
//}

//trait A{
//    public $value = "ycjung";
//}
//class B{
//    use A;
//    function test(){
//        echo $this->value;
//    }
//}
//$obj = new B;
//$obj->test();





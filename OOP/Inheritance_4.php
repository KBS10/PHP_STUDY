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

////////////////////////////////////////////////////////////

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

class A{
    public $ma = 10;
    public $mb = 20;

    function __clone(){
        echo "__clone() is invoked <br>";
    }
    function setMB($argValue){
        $this->mb = $argValue;
    }
}

$obj = new A();
$obj->setMB(18);

$objClone = clone $obj;

echo "MB value of the cloned object : ".$objClone ->mb;



















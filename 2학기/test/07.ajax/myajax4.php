<?php
// 입력 값을 JSON으로 decoding실시 -> 객체 생성
$receivedData = json_decode(file_get_contents('php://input'));
class UInfo{
    public $name, $age, $phone, $univ;
    public function __construct(){
        $argNum = func_num_args(); // function arguments의 개수 획득
        $argList = func_get_args(); // 입력된 arguments의 값을 1차원 배열로 반환

        //생성자 argument가 1개일 경우
        if($argNum == 1){
            $this->name = $argList[0] -> name;
            $this->age = $argList[0] -> age;
            $this->phone = $argList[0] -> phone;
            $this->univ = "Yeungjin Univ.";
        }

        //생성자가 argument가 4개일 경우
        if($argNum == 4){
            $this->name = $argList[1];
            $this->age = $argList[2];
            $this->phone = $argList[3];
            $this->univ = "Yeungjin Univ.";
        }
    }
}
$myObj[] = new UInfo($receivedData);
$myObj[] = new UInfo(null, "원태인",32,"123-983-2932");

//객체 값을 JSON 포맷 인코딩 후 추력
echo json_encode($myObj);
?>
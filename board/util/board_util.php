<?php
require_once ('Conf/board_conf.php');

// Error 메세지 출력
function prtErrorMsg($errorMsg){
    echo "<script> alert('$errorMsg');</script>";
}
// page 이동하는 함수
function pageMove($fileName){
    echo "<script>location.href='./?page=$fileName';</script>";
}

// data의 입력에 대해
function dataValidation($dataType, $argList, $htmlStripTageOn){
    switch($dataType){
        case "POST":
            $data = $_POST;
            break;
        case "GET":
            $data = $_GET;
            break;
        default:
            return false;
    }
    $getArrayData = [];
    foreach($argList as $value){
        // HTML태그를 HTML specialchars로 태그 제거
        if($htmlStripTageOn){
            $getArrayData[$value] = htmlspecialchars($data[$value]);
        }else{
            $getArrayData[$value] = $data[$value];
        }
    }
    return $getArrayData;
}

function logout(){
    if(isset($_SESSION['id']) == true){
        session_destroy();
    }else{
        prtErrorMsg("잘못된 접근입니다.");
    }
    pageMove(Board_Info::FILENAME_LIST);
}

if(array_key_exists('logout',$_POST)){
    logout();
}

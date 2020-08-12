<?php
// 일일히 코드에 적을 시 불편하기 때문에
// 하나의 클래스로 파일의 이름을 저장
class Board_Info{
    const FILENAME_WRITE            = "write.php";
    const FILENAME_MODIFY           = "modify.php";
    const FILENAME_VIEW             = "view.php";
    const FILENAME_LIST             = "list.php";
    const FILENAME_DELETE           = "delete.php";
    const FILENAME_LOGIN_PROCESS    = "login_process.php";
    const FILENAME_WRITE_PROCESS    = "write_process.php";
    const FILENAME_MODIFY_PROCESS   = "modify_process.php";
    const FILENAME_DELETE_PROCESS   = "delete_process.php";
    const FILENAME_COMMENT_WRITE_PROCESS = "comment_write_process.php";

    const IS_DEBUG_MODE = false; // Debug 모드
    const NUM_OF_RECORDS_PER_PAG = 5; // 페이지 당 게시글 수
    const IS_PAGINATION = true;
    const IS_HIT_INCREASE = true;
}


function checkGETBoard_ID(){
    if(isset($_GET['board_id'])&& is_numeric($_GET['board_id'])){
        $writeNumber = $_GET['board_id'];
    }else{
        $writeNumber = 0;
    }
    return $writeNumber;
}

//DBMS 연결
function makeDBConnection(){
    // DBMS 연결
    $db_conn = new mysqli(db_info::DB_URL, db_info::USER_ID,
        db_info::PASSWD, db_info::DB_NAME);

    // DBMS 연결 실패 여부 검사
    if($db_conn->connect_errno){
        echo "시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 1)";
        exit(-1); // 시스템 종료
    }
    return $db_conn;
}

// $dataType : String(data의 확장성 고려), $argList : Array(배열의 값을 저장), $htmlStripTageOn : boolean(HTML Tag처리)
// $_POST의 지속적인 사용을 편리하게 하기 위해
function dataValidation($dataType, $argList, $htmlStripTageOn){
    switch($dataType){
        case "POST":
            $data = $_POST;
        break;
        case "GET":
            $data = $_GET;
        default:
            return false;
    }

    // POST, GET방식으로 넘어올수 있는 값들을 저장하는 배열
    $getArrayData = [];

    // 데이터 무결성 검사
    // $dataType = "POST", $argList =["name","id"]
    // 공백 혹은 빈칸이 있을 시 return 값 false
    foreach($argList as $value){
        if(!isset($data[$value])|| $data[$value] == "")return false;

        // HTML태그를 HTML specialchars로 태그 제거
        if($htmlStripTageOn){
            $getArrayData[$value] = htmlspecialchars($data[$value]);
        }else{
            $getArrayData[$value] = $data[$value];
        }
    }
    return $getArrayData;
}
// page 이동하는 함수
function pageMove($fileName){
    echo "<script>location.href='$fileName';</script>";
}


// 오류 메세지를 출력하는 함수
// 오류 메세지를 출력하고 list.php로 이동
function prtErrorMsg($errorMsg){
    echo "<script>
            alert('$errorMsg');
            location.href='list.php';
          </script>";
}

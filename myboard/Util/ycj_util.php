<?php
require_once('Conf/board_conf.php');

// POST, GET 데이터 무결성 검사
function dataValidation($dataType, $argList, $htmlStripTagOn)
{
    switch ($dataType) {
        case "POST":
            $data = $_POST;
            break;
        case "GET":
            $data = $_GET;
            break;
        default :
            return false;
    }

    $rcvdData = [];

    // 데이터 무결성 검사
    foreach ($argList as $value) {
        if (!isset($data[$value]) || $data[$value] == "")
            return false;

        if ($htmlStripTagOn) {
            // HTML 태그 제거
            $rcvdData[$value] = htmlspecialchars($data[$value]);
        } else
            $rcvdData[$value] = $data[$value];
    }

    return $rcvdData;
}

// 페이지 이동 JS 스크립트 작성
function pageRedirect($fileName)
{
    echo "
        <script>
            location.href = '" . BoardInfo::URL . BoardInfo::PATH . $fileName . "';
        </script>
    ";
}

// 페이지 이동 JS 스크립트 작성
function pageRedirectWithPostMsg($fileName, $formValues)
{
    echo "
        <body>
        <script>
            let form = document.createElement(\"form\");
            form.action = \"".BoardInfo::URL . BoardInfo::PATH . $fileName."\";
            form.method = \"post\";
            let input;";

            foreach ($formValues as $key => $value) {
                echo " 
                        input = document.createElement(\"input\");
                        input.type = \"hidden\";
                        input.name = \"$key\";
                        input.value = \"$value\";
                        form.appendChild(input);
                        document.body.appendChild(form);
                ";
            }
     echo "form.submit(); </script></body>";
}

// 에러 메시지 출력
function prtErrorMsg()
{
    echo "
        <script>
            location.href = '" . BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_ERROR . "';
        </script>
        ";

    exit(-1);
}

// JS 경고창 출력 후 리스트 페이지 이동
function prtAlertGoToList($msg) {
    echo "
        <script>
            alert('$msg');
            location.href = '" . BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_LIST. "';
        </script>
        ";

    exit(-1);
}

// 지정 모듈에 대한 URL 획득
function getURL($moduleName) {
    $url = BoardInfo::URL . BoardInfo::PATH;

    switch($moduleName) {
        case "write":
            $url .= BoardInfo::FILENAME_WRITE;
            break;
        case "list":
            $url .= BoardInfo::FILENAME_LIST;
            break;
        case "delete":
            $url .= BoardInfo::FILENAME_DELETE;
            break;
        case "modify":
            $url .= BoardInfo::FILENAME_MODIFY;
            break;
        case "error":
            $url .= BoardInfo::FILENAME_ERROR;
            break;
    }
    return $url;
}
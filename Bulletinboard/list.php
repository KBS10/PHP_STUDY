<?php
require_once('DB.php');
require_once('my_util.php');
// 세션 시작 : 세션기능을 사용 하기 전 반드시 선 실행
session_start();

//////////////////////////////////////////////////////////
// php 오류 확인 하는 코드
error_reporting(E_ALL);
ini_set("display_errors", 1);
//////////////////////////////////////////////////////////

// 글의 총 개수 (select * from table;)
// 페이지당 출력 글 개수 : 10
// 블럭 내 페이지 넘버 개수  : 5
// 현재 페이지 번호 ( POST, GET  수신 없으면 0)
// 총 페이지 개수 = ceil(글의 총 갯수 / 페이지당 출력 글 개수)

if(Board_Info::IS_PAGINATION)
    $pagingInfo = getPagingInfo();

function getPagingInfo(){
    $currentPageNum = 0; // 현 페이지 번호
    $pagingStartNum = 0; // 현 페이지 기준, 화면 출력 시작 글 번호
    $pagingEndNum   = 0; // 현 페이지 기준, 화면 출력 종료 글 번호
    $totalRowNum    = 0; // Model 테이블 내 저장된 총 게시글 수
    $totalPageNum   = 0; // 총 페이지 수

    // 현 게시판 내용 출력이 검색 모드 조건 내 실행 구분
    $isSearchingMode = false;
    $searchingSql = "";
    // 현재 페이지 값을 출력 GET 값으로 수신 (초기 값 0)
    if(isset($_GET['currentPageNum']) && is_numeric($_GET['currentPageNum']))
        $currentPageNum = $_GET['currentPageNum'];
    else
        $currentPageNum = 0;

    if($getArrayData = dataValidation("POST", ['keyword', 'keyword_text'], false)) {
        $isSearchingMode = true;
        $searchingSql = "like '%$getArrayData[keyword_text]%'";
        switch ($getArrayData['keyword']) {
            case "title" :
                $searchingSql = "title " . $searchingSql;
                break;
            case "name":
                $searchingSql = "user_name " . $searchingSql;
                break;
            case "contents":
                $searchingSql = "contents " . $searchingSql;
                break;
            case "titlePlusContents" :
                $searchingSql = "title " . $searchingSql . " or  contents " . $searchingSql;
                break;
        }
    }

    // DBMS 연결
    $db_conn = makeDBConnection();

    $sql = "select count(*) from ". db_info::DB_TABLE .($searchingSql != ""? " where ". $searchingSql : "");

    // DB에 저장된 열에대해 쿼리를 보냄
    if(!$result = $db_conn ->query($sql)){
        echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
        exit(-1); // 시스템 종료 : PHP 엔진 번역 작업 중지
    }
    $totalRowNum    = $result ->fetch_array()[0];

    // 총 페이지수 : 총 게시물 수 / 페이지 당 리스트 수
    $totalPageNum     = ceil($totalRowNum / Board_Info::NUM_OF_RECORDS_PER_PAG);

    // 현페이지 기준 출력 게시물 시작글, 종료글 번호 계산
    $pagingStartNum = $currentPageNum * Board_Info::NUM_OF_RECORDS_PER_PAG;
    $pagingEndNum   = Board_Info::NUM_OF_RECORDS_PER_PAG;

    if(Board_Info::IS_DEBUG_MODE){
        echo "For debugging<br>";
        echo "Total Row      : " .$totalRowNum. "<br>";
        echo "Total Page Num : " .$totalPageNum. "<br>";
        echo "PagingStartNum : " .$pagingStartNum. "<br>";
        echo "PagingEndNum   : " .$pagingEndNum. "<br>";
        echo "currentPageNum : " .$currentPageNum. "<br>";
        if($isSearchingMode){
            echo "searching keyword : " .$getArrayData['keyword']. "<br>";
            echo "searching keyword text : " .$getArrayData['keyword_text']. "<br>";}
        echo "sql : "       .$sql. "<br>";}
    return["currentPageNum"     => $currentPageNum, // 현 페이지 번호
            "pagingStartNum"    => $pagingStartNum, // 현 페이지 기준 시작 글 번호
            "pagingEndNum"      => $pagingEndNum,   // 현 페이지 기준 종료 글 번호
            "totalRowNum"       => $totalRowNum,    // Model 테이블 내 저장된 총 게시글 수
            "totalPageNum"      => $totalPageNum,   // 총 페이지 수
            "isSearchingMode"   => $isSearchingMode,
//            "keyword"           => $getArrayData['keyword'],
//            "keyword_text"      => $getArrayData['keyword_text'],
            "searchingSql"      => $searchingSql];}

// 게시글 목록 HTML 출력
function prtList($argPagingInfo){
    // DBMS 연결
    $db_conn = makeDBConnection();
    if($argPagingInfo['isSearchingMode']){
        $sql = "select * from " .db_info::DB_TABLE. " where " .$argPagingInfo['searchingSql'] ." 
        and board_pid = 0 order by board_id desc";
    }else{
        // SQL문 작성 : 댓글을 제외한 모든 게시글 입력 역순으로 획득
        $sql = "select * from " .db_Info::DB_TABLE." where board_pid = 0 order by board_id desc";
    }
    if(Board_Info::IS_PAGINATION){
        $sql .= " limit " . $argPagingInfo['pagingStartNum']. ", ". $argPagingInfo['pagingEndNum'];
    }

    // DBMS 연결 실패 여부 검사
    if(!$result = $db_conn ->query($sql)){
         echo"시스템 오류 시스템 관리자에게 문의 바랍니다. (Code num 2)";
         exit(-1); // 시스템 종료
    }

    while($row = $result->fetch_array()){
        echo ("<tr> \n");echo ("<td width = 50 align = center> $row[board_id] </td>\n");
        if($argPagingInfo['isSearchingMode']){
            // 검색 모드 인경우 board_id, keyword+keword_text
            // View -> List로 리다이렉션시 검색 된 결과 페이지 유지하기 위해
            echo ("<td width = 500 align = center>
            <a href='view.php?board_id=$row[board_id]' onclick='sendPostMsgList('".Board_Info::FILENAME_VIEW. "',
            {name : 'page_num' , value : $argPagingInfo[currentPageNum]},
            {name : 'keyword', value : $argPagingInfo[keyword]'},
            {name : 'keyword_text', value : $argPagingInfo[keyword_text]'}])> $row[title] </a></td>\n");
        }else{
            echo ("<td width = 500 align = center><a href='view.php?board_id=$row[board_id]'> $row[title] </a></td>\n");
        }
        echo ("<td width = 50 align = center> $row[user_name] </td>\n");
        echo ("<td width = 50 align = center> $row[hits] </td>\n");
        // date_create("mysql 날짜 시간 값") -> DateTime 클래스의 객체 반환
        // date_format(DateTime 객체, 출력 포맷)
        echo ("<td width = 100 align = center> ".date_format(date_create($row['reg_date']),'Y-m-d')." </td>\n");
        echo ("</tr> \n");
    }
}

function prtPagination($argPagingInfo){
    $currentPageNum = $argPagingInfo['currentPageNum'];
    $totalPageNum = $argPagingInfo['totalPageNum'];
    echo "<div id='page' align='center'>";
    // 이전 부분
    if( $currentPageNum > 0){
        $PREV_PAGE = $currentPageNum - 1;
        echo "<a href='list.php?currentPageNum=$PREV_PAGE'>이전</a>";}
    // 페이지 번호 리스트 출력
    for($icount = 0; $icount < $totalPageNum; $icount++){
        $list_show_page = $icount + 1;
        echo "<a href='list.php?currentPageNum=$icount'> $list_show_page </a>";}
    // 다음 부분
    if($currentPageNum < $totalPageNum - 1){
        $NEXT_PAGE = $currentPageNum + 1;
        echo "<a href='list.php?currentPageNum=$NEXT_PAGE'>다음</a>";}
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            border-top: 1px solid #444444;
            border-collapse: collapse;
        }
        tr{
            border-bottom: 1px solid #444444;
            padding: 10px;
        }
        td{
            border-bottom: 1px solid #efefef;
            padding: 10px;
        }
        table .even{
            background: #efefef;
        }
        .text{
            text-align:center;
            padding-top:20px;
            color:#000000
        }
        .text:hover{
            text-decoration: underline;
        }
        #page{
            text-align: center;
        }
        a:link {color : #57A0EE; text-decoration:none;}
        a:hover { text-decoration : underline;}
        .view_btn_list,
        .view_btn_write,{
            height: 50px;
            width: 100px;
            font-size: 20px;
            text-align: center;
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
        }
        #login_form{
            text-align: right;
        }
    </style>
</head>

<body>

<?php
function logout(){
    if(isset($_SESSION['id']) == true){
        session_destroy();
    }
    pageMove(Board_Info::FILENAME_LIST);
}

if(array_key_exists('logout',$_POST)){
    logout();
}
?>

<?php if(isset($_SESSION['id']) == false && isset($_SESSION['password']) == false ): ?>
    <form id="login_form" name="login_form" method="post" action=<?php echo Board_Info::FILENAME_LOGIN_PROCESS; ?>>
        ID : <input type="text" name="id">
        암호 : <input type="password" name="password">
        <input type="submit" name="로그인하기" value="Login">
    </form>
<?PHP else: ?>
    <form method='post' id="login_form">
        <?PHP echo $_SESSION['name']; ?> 님이 로그인 하셨습니다.
        나이 : <?PHP echo $_SESSION['age']; ?>
        회원등급 : <?PHP echo $_SESSION['grade']; ?>
            <input type='submit' value = '로그아웃' name='logout'>
        </form>
    </div>
<?PHP endif; ?>
    <h2 align=center>게시판</h2>
    <table align = center>
        <thead align = "center">
        <tr><td width = "50" align="center">번호</td>
            <td width = "500" align = "center">제목</td>
            <td width = "50" align = "center">작성자</td>
            <td width = "50" align = "center">조회수</td>
            <td width = "70" align = "center">날짜</td></tr></thead>
        <tbody>
        <?php prtList($pagingInfo); ?>
        </tbody>
    </table>
    <?php prtPagination($pagingInfo); ?>
    <div class = text>

        <?php if(isset($_SESSION['id']) == true && isset($_SESSION['password']) == true ): ?>
            <button class="view_btn_write" onClick="location.href='./<?PHP echo Board_Info::FILENAME_WRITE?>'">글쓰기</button>
        <?PHP endif; ?>
        <button class="view_btn_list" onClick="location.href='./<?PHP echo Board_Info::FILENAME_LIST?>'">글목록</button>
    </div>

<div id = "search_box" style="text-align: center;">
    <form  method="post" action=<?php echo Board_Info::FILENAME_LIST; ?>>
    <select name="keyword">
        <option value ="title">제목</option>
        <option value ="name">글쓴이</option>
        <option value ="contents">내용</option>
        <option value ="titlePlusContents">제목+내용</option>
    </select>
    <input type="text" name="keyword_text" size="40" required="required">
    <input type="submit" class="search"  value="검색">
    </form>

    <script>
        function sendPostMsgList(argUrl, argData){
            let form = document.createElement("form");
            form.action = argUrl;
            form.method = "post";

            for(let value of argData){
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = value.name;
                input.value = value.value;
                form.appendChild(input);
                document.body.appendChild(form);
            }
            form.submit();
        }
    </script>
</div>
</body>
</html>
<?php
// 현 페이지 값을 POST 값으로 수신,
// 수신된 값이 없을 경우 현 페이지를 첫 페이지로 설정
if (isset($_GET['currentPageNum']) && is_numeric($_GET['currentPageNum']) && $_GET['currentPageNum'] >= 0)
$currentPageNum = $_GET['currentPageNum'];
else
$currentPageNum = 0;
//  Pagination 정보 획득
if( $getData = dataValidation("POST", ['keyword', 'keyword_text'], false)) {
// 검색 모드 경우
$pagingInfo = getPagingInfo($currentPageNum, $getData['keyword'], $getData['keyword_text']);
} else {
// 검색 모드가 아닐 경우
$pagingInfo = getPagingInfo($currentPageNum, null, null);
}
//  DBMS로부터 현 페이지에 대한 글 목록 획득
$articleList = getBoardList($pagingInfo['totalRowNum'], $pagingInfo['pagingStartNum'], $pagingInfo['pagingEndNum'],
$pagingInfo['isSearchingMode'], $pagingInfo['keyword'], $pagingInfo['keyword_text']);

?>

<?php if(isset($_SESSION['id']) == false && isset($_SESSION['password']) == false ): ?>
    <form id="login_form" name="login_form" method="post" action=<?php echo "./?page=".Board_Info::FILENAME_LOGIN_PROCESS; ?>>
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
    <?php
    foreach($articleList as $article){
        echo ("<tr> \n");
        echo ("<td width = 50 align = center> $article->board_id </td>\n");
        echo ("<td width = 500 align = center><a href='./?page=".Board_Info::FILENAME_VIEW."&board_id=$article->board_id'> $article->title </a></td>\n");
        echo ("<td width = 50 align = center> $article->user_name </td>\n");
        echo ("<td width = 50 align = center> $article->hits </td>\n");
        echo ("<td width = 100 align = center> ".date_format(date_create($article->reg_date),'Y-m-d')." </td>\n");
        echo ("</tr> \n");
    }
    ?>
    </tbody>
</table>
    <?php $pageNumbers = getPageNumberList($pagingInfo); ?>
<div class = text align="center">
    <?php if(isset($_SESSION['id']) == true && isset($_SESSION['password']) == true ): ?>
    <button class="view_btn_write" onClick="location.href='./?page=<?PHP echo Board_Info::FILENAME_WRITE?>'">글쓰기</button>
    <?PHP endif; ?>
    <button class="view_btn_list" onClick="location.href='./?page=<?PHP echo Board_Info::FILENAME_LIST?>'">글목록</button>
</div>

<form  method="post" align="center" action=<?php echo "?page=".Board_Info::FILENAME_LIST; ?>>
    <select name="keyword">
        <option value ="title">제목</option>
        <option value ="name">글쓴이</option>
        <option value ="contents">내용</option>
        <option value ="titlePlusContents">제목+내용</option>
    </select>
    <input type="text" name="keyword_text" size="40" required="required">
    <input type="submit" class="search"  value="검색">
</form>
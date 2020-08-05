<?php
// View 출력
// 게시글 목록 : $articleList
// 페이지화 관련 변수 :  $pagingInfo
// 페이지 번호 목록 Ex)<< 1, 2, 3 >> :  $pageNumbers
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>글쓰기</title>
    <link rel="stylesheet" href="View/myStyle.css" type="text/css">
</head>
<body>
<fieldset style="width:1000px">
    <table style="width:1000px">
        <!-- 게시글 테이블 Header cell 출력 -->
        <tr>
            <th colspan="5">YC Jung 게시판</th>
        </tr>
        <tr>
            <th width="50">번호</th>
            <th width="500">제목</th>
            <th>작성자</th>
            <th width="50">조회수</th>
            <th>날짜</th>
        </tr>

        <!-- PHP codes for printing out articles -->
        <!-- 게시글 목록 출력 -->
        <?php
        // 게시글 목록 HTML 출력
        foreach ($articleList as $article ) {
            echo("<tr>\n");
            // 게시글 번호
            echo("<td align=center> $article->board_id  </td>\n");
            echo("<td align=center>");

            // <<-- 글 제목 출력, 글 제목 클릭 시 글보기 연결 링크 설정  시작 -->>
            if ($pagingInfo['isSearchingMode']) {
                // 검색 모드일 경우 : 글 번호, 검색 키워드 항목, 검색어 POST 전달
                echo "<a href='#'  onclick=\"sendPostMsgList('" . BoardInfo::FILENAME_VIEW .
                    "', [{name : 'board_id', value : $article->board_id}, 
                                                    {name : 'page_num', value : $pagingInfo[currentPageNum]},
                                                    {name : 'keyword', value : '$pagingInfo[keyword]'},
                                                    {name : 'keyword_text', value : '$pagingInfo[keyword_text]'}] )\" >
                                                    $article->title</a></td>\n";
            } else {
                // 검색 모드가 아닐 경우 : 글 번호 POST 전달
                echo "<a href='#'  onclick=\"sendPostMsgList('" . BoardInfo::FILENAME_VIEW .
                    "', [{name : 'board_id', value : $article->board_id}, 
                                                    {name : 'page_num', value : $pagingInfo[currentPageNum]}] )\" >
                                                    $article->title</a></td>\n";
            }
            // <<-- 글 제목 출력, 글 제목 클릭 시 글보기 연결 링크 설정  종료 -->>

            // 게시글 작성자
            echo "<td align=center> $article->user_name  </td>\n";
            // 게시글 조회수
            echo "<td align=center> $article->hits  </td>\n";
            // 게시글 작성 날짜
            echo "<td align=center> " . date_format(date_create($article->reg_date), 'Y-m-d') . "</td>\n";
            echo "</tr>\n";
        }
        ?>
        <!-- PHP codes for printing out articles -->

    </table>
    <br>
    <div align="center">
        <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
            검색 키워드
            <select name="keyword">
                <option value="title">제목</option>
                <option value="content">내용</option>
                <option value="user_name">작성자</option>
                <option value="title_content">제목+내용</option>
            </select>
            <input type="text" name="keyword_text" style="width: 30%">
            <input type="submit" value="검색">
        </form>
    </div>
    <br>


    <?php
    // 페이지 번호 HTML 출력
    echo $pageNumbers;
    ?>


    <!-- 글쓰기 모듈 이동 -->
    <input type="button" name="write" value="글쓰기" onclick="doRedirect('<?php echo getURL('write'); ?>')">


    <!-- 검색 모드일 경우, 검색 모드 해제 버튼 출력 -->
    <?php
    if ($pagingInfo['isSearchingMode'])
        echo "<input type='button' name='list' value='리스트' ".
            "onclick=\"sendPostMsgList('$_SERVER[PHP_SELF]',
                       [{name : 'page_num', value : 0}, {name : 'keyword', value : ''},
                       {name : 'keyword_text', value : ''}])\">\n";
    ?>


</fieldset>
</body>
<script src="js/board_js.js"></script>
</html>
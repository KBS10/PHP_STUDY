<?php
// 게시글 레코드 :  $article
// 댓글 목록 :  $commentList
// Pagination, Searching 관련 변수 : $rcvdData['page_num'], $rcvdData['keyword'], $rcvdData['keyword_text']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="View/myStyle.css" type="text/css">
</head>
<body>
<fieldset style="width:700px">
    <legend>글보기 : 글 번호 <?php echo $article->board_id; ?></legend>
    <table style="100%">
        <tr>
            <td>제목</td>
            <td><?php echo $article->title; ?></td>
        </tr>
        <tr>
            <td>작성자</td>
            <td><?php echo $article->user_name; ?></td>
        </tr>
        <tr>
            <td>작성시간</td>
            <td><?php echo date_format(date_create($article->reg_date), 'Y년 m월 d일 h시 i분 s초'); ?> </td>
        </tr>
        <tr>
            <td>조회수</td>
            <td><?php echo $article->hits; ?> </td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="content" rows="20"
                                      cols="92" readonly><?php echo $article->contents; ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                <!-- 글쓰기 버튼 시작 -->
                <input type="button" name="list" value="글목록"
                <?php
                // 검색 모드일 경우 : 검색 키워드 항목, 검색어 POST 전달
                if ($rcvdData['keyword'] != "") {
                    echo "onclick = \"sendPostMsgList('" . BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_LIST . "',
                                                   [{name: 'page_num', value: $rcvdData[page_num]}, {name: 'keyword' , value: '$rcvdData[keyword]'},
                                                   {name: 'keyword_text', value: '$rcvdData[keyword_text]'}])\">\n";
                } else {
                    echo "onclick=\"sendPostMsgList('" . BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_LIST . "',
                                                    [{name : 'page_num', value : $rcvdData[page_num]}])\">\n";
                }
                ?>
                <!-- 글쓰기 버튼 종료 -->

                <!-- 글삭제 버튼 시작 -->
                <input type="button" name="delete" value="글삭제"
                       onclick="sendPostMsgList('<?php echo BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_DELETE; ?> ',
                           [{name : 'board_id', value :  <?php echo $article->board_id; ?>}])">
                <!-- 글삭제 버튼 종료 -->

                <!-- 글수정 버튼 시작 -->
                <input type="button" name="modify" value="글수정"
                       onclick="sendPostMsgList('<?php echo BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_MODIFY; ?>',
                           [{name : 'board_id', value :  <?php echo $article->board_id; ?>}])">
                <!-- 글수정 버튼 종료 -->
            </td>
        </tr>
    </table>
    <br><br>
    <legend>댓글</legend>
    <table style="100%">
        <form method="POST" action=<?php echo BoardInfo::FILENAME_COMMENT_WRITE_PROCESS; ?>>
            <input type="hidden" name="board_id" value="<?php echo $article->board_id; ?>">
            <tr>
                <td width="20%">코멘트</td>
                <td style="text-align: left"><input type="text" name="content" style="width: 70%"></td>
            </tr>
            <tr>
                <td width="20%">작성자</td>
                <td style="text-align: left"><input type="text" name="user_name" style="width: 70%"></td>
            </tr>
            <tr>
                <td width="20%">비밀번호</td>
                </td>
                <td style="text-align: left"><input type="text" name="user_passwd" style="width: 70%"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="댓글쓰기"></td>
            </tr>
        </form>
    </table>
    <table style="width:100%">
        <tr>
            <th>
                작성자
            </th>
            <th width="50%">
                코멘트
            </th>
            <th>
                작성일
            </th>
            <th>
                삭제
            </th>
        </tr>


        <!-- 댓글 출력 시작 -->
        <?php
        foreach ($commentList as $comment) {
            echo "<tr>
                <td>$comment->user_name</td>
                <td width>$comment->contents</td>
                <td>" . date_format(date_create($comment->reg_date), 'Y-m-d') . "</td>
                <td><input type='button' value='삭제' 
                            onclick=\"sendPostMsgList('" . BoardInfo::URL . BoardInfo::PATH . BoardInfo::FILENAME_DELETE . "',
                            [{name: 'board_id', value: '$comment->board_id'}, {name: 'isComment', value: 'true'},
                            {name: 'pboard_id', value: '$comment->board_pid'}]
                            )\"></td>
            </tr>";
        }
        ?>
        <!-- 댓글 출력 종료-->


    </table>
</fieldset>
</body>
<script src="js/board_js.js"></script>
</html>
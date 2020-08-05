<?php
// 수정 글 View 출력
// 수정 글 레코드 :  $article
// 게시 글 번호 :  $board_id
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>글 수정</title>
    <link rel="stylesheet" href="View/myStyle.css" type="text/css">
</head>
<body>
<fieldset style="width:700px">
    <legend>글 수정 : 글 번호 <?php echo $article->board_id; ?></legend>
    <form method="post" action=<?php echo BoardInfo::FILENAME_MODIFY_PROCESS; ?>>
        <input type="hidden" name="board_id" value="<?php echo $article->board_id; ?>">
        <table style="100%">
            <tr>
                <td>제목</td>
                <td><input type="text" name="title" style="width: 80%" value="<?php echo $article->title; ?>">
                </td>
            </tr>
            <tr>
                <td>작성자</td>
                <td><input type="text" name="user_name" style="width: 80%"
                           value="<?php echo $article->user_name; ?>"></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="text" name="user_passwd" style="width: 80%"></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="content" rows="20"
                                          cols="92"><?php echo $article->contents; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <!-- 글목록, 글수정 모듈 이동 -->
                    <input type="button" name="list" value="글목록" onclick="doRedirect('<?php echo getURL('list'); ?>')">
                    <input type="submit" name="modify_process" value="글수정">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
<script src="js/board_js.js"></script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>글쓰기</title>
    <link rel="stylesheet" href="View/myStyle.css" type="text/css">
</head>
<body>
<fieldset style="width:700px">
    <legend>글쓰기</legend>
    <form method="post" action=<?php echo BoardInfo::FILENAME_WRITE_PROCESS; ?>>
        <table style="100%">
            <tr>
                <td>제목</td>
                <td><input type="text" name="title" style="width: 80%"></td>
            </tr>
            <tr>
                <td>작성자</td>
                <td><input type="text" name="user_name" style="width: 80%"></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="text" name="user_passwd" style="width: 80%"></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="content" rows="20" cols="92"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="글쓰기" style="width: 100%"></td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>


<form method="post" align=center action=<?php echo "?page=".Board_Info::FILENAME_MODIFY_PROCESS."&board_id=".$_GET['board_id']; ?>>
    <input type="hidden" name="action" value="insert">
    <table align=center>
        <tr>
            <td colspan="2">글 번호 <?PHP echo $_GET['board_id']?></td>
        </tr>
        <tr>
            <td>제목</td>
            <td><input type="text" name="title" required></td>
        </tr>
        <tr>
            <td colspan="2">
                <textarea name="content" required></textarea>
            </td>
        </tr>
        <input type="text" name="user_name" value=<?PHP echo $_SESSION['id'] ?> hidden>
        <input type="text" name="user_passwd" value=<?PHP echo $_SESSION['password'] ?> hidden>
    </table>
<div align="center">
    <input type="submit" value="수정하기" name="write">
</form>
    <input type="button" value="글목록" name="write" onclick="location.href='./?page=list'">
</div>
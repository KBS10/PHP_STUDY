<?php
if(isset($_SESSION['id']) == false && isset($_SESSION['password']) == false){
prtErrorMsg("잘못된 접근입니다.");
pageMove(Board_Info::FILENAME_LIST);
}
?>
<form method="post" action=<?php echo Board_Info::FILENAME_WRITE_PROCESS; ?>>
    <table>
        <tr>
            <td>글쓰기</td>
        </tr>
        <tr>
            <td>제목</td>
            <td><input type="text" name="title" required></td>
        </tr>
        <tr>
            <td>작성자</td>
            <td><?php $_SESSION['id']; ?></td>
        </tr>
        <tr>
            <td>
                <textarea name="content" required></textarea>
            </td>
        </tr>
        <input type="text" name="user_name" value=<?PHP echo $_SESSION['id'] ?> hidden>
        <input type="text" name="user_passwd" value=<?PHP echo $_SESSION['password'] ?> hidden>
        <input type="submit" value="작성" name="write">
    </table>
</form>
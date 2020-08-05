<?php
// 글 삭제 뷰 출력
// 삭제 글 번호 :  $board_id
// 댓글 플래그 : $isComment
// 댓글 번호 : $pBoardId
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>글 삭제</title>
    <link rel="stylesheet" href="View/myStyle.css" type="text/css">
</head>
<body>
<fieldset style="width:700px">
    <legend>글 삭제 : 글 번호 <?php echo $board_id; ?></legend>
<form method="post" action=<?php echo BoardInfo::FILENAME_DELETE_PROCESS; ?>>
    <!-- Board ID POST Hidden 값 전송 -->
    <input type="hidden" name="board_id" value="<?php echo $board_id; ?>">
    <?php
    // 댓글인 경우, 댓글 Flag, 댓글 번호 POST 값으로 전송
    if($isComment) {
        echo "<input type='hidden' name='isComment' value='true'>";
        echo "<input type='hidden' name='pboard_id' value='".$pBoardId."'>";
    }
    ?>

    <table style="100%">
        <tr>
            <td>비밀번호</td>
            <td><input type="text" name="user_passwd" style="width: 80%"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit"  value="글삭제">
            </td>
        </tr>
    </table>
</form>
</fieldset>
</body>
</html>

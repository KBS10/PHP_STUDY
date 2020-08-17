<?php
require_once ('Conf/board_conf.php');
orderDB("updateCount",$_GET['board_id'],null,null,null,null);
$board = getArticleByBoardId($_GET['board_id']);
$commentList = getCommentList($_GET['board_id']);

?>
<table class="view_table" align="center">
    <caption>글 번호 : <?php echo $board->board_id?></caption>
        <tr>
            <td colspan="2" class="view_title"><?php echo $board->title?></td>
        </tr>
        <tr>
            <td class="view_username1">작성자</td>
            <td class="view_username2"><?php echo $board->user_name?></td>
        </tr>
        <tr>
            <td class="view_reg_date1">작성시간</td>
            <td class="view_reg_date2"><?php echo date_format(date_create($board->reg_date), 'Y년 m월 d일 h시 i분 s초');?></td></tr>
        <tr>
            <td class="view_hits1">조회수</td>
            <td class="view_hits2"><?php echo $board->hits?></td>
        </tr>
        <tr>
            <td colspan="2" class="view_content" valign="top"><?php echo $board->contents ?></td>
        </tr>
</table>

<div class="view_btn" align="center">
    <button class="view_btn_list"   onClick="location.href='./?page=list'">글목록</button>
    <?php if(isset($_SESSION['id']) && $_SESSION['id'] == $board->user_name): ?>
        <button class="view_btn_delete" onClick="location.href='./?page=delete&board_id=<?PHP echo $_GET['board_id']?>'">글삭제</button>
        <button class="view_btn_modify" onClick="location.href='./?page=modify&board_id=<?PHP echo $_GET['board_id']?>'">글수정</button>
    <?PHP endif; ?>
</div>

<?php if(isset($_SESSION['id'])): ?>
    <div class="view__write_comment" align="center">
        <form method="post" action=<?php echo "./?page=".Board_Info::FILENAME_COMMENT_WRITE_PROCESS."&board_id=".$_GET['board_id']; ?>>
            <table>
                <caption>댓글</caption>
                <tr>
                    <th style="width: 200px">코멘트</th>
                    <td><input type="text" name="comment" style="width: 800px"></td>
                </tr>
                <input type="text" name="comment_writer" value=<?PHP echo $_SESSION['id'];?> hidden style="width: 800px"></td></tr>
                <input type="text" name="comment_password" value=<?PHP echo $_SESSION['password'];?> hidden style="width: 800px"></td></tr>
            </table>
            <input class="view_input_comment_write" type="submit" name="comment_write" value="댓글 쓰기">
        </form>
    </div>
<?PHP endif; ?>

<table class="view_comment" align="center">
    <tr id="view_comment_header"><th>작성자</th>
        <th>코멘트</th>
        <th>작성일</th>
        <th>삭제</th>
    </tr>
    <?PHP
    foreach($commentList as $comment){
        echo ("<tr> \n");
        echo ("<td width = 50 align = center> $comment->user_name </td>\n");
        echo ("<td width = 50 align = center> $comment->contents </td>\n");
        echo ("<td width = 100 align = center> ".date_format(date_create($comment->reg_date),'Y-m-d')." </td>\n");
        if (isset($_SESSION['id']) && $_SESSION['id'] == $comment->user_name):
            echo("<td width = 50 align = center><input type='button' value='삭제'></td>");
        endif;
        echo ("</tr> \n");
    }
    ?>
</table>


<div>글 삭제 : <?php echo "글 번호".$_GET['board_id']?></div>
<form method="post" action="<?php echo "./?page=".Board_Info::FILENAME_DELETE_PROCESS."&board_id=".$_GET['board_id'];?>">
    <div> 비밀번호 : </div>
    <input type="text" name="user_passwd">
    <input type="submit" onclick="location.href='./?page=delete_process.php&board_id=<?PHP echo $_GET['board_id']?>" value="글삭제">
</form>
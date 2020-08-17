<?php
if($getArrayData = dataValidation('POST',['user_passwd'], false)){

    if($passwordCheck = passwordCheck($_GET['board_id'], $getArrayData['user_passwd']) == 1){

        orderDB("deletBoard",$_GET['board_id']);

        pageMove(Board_Info::FILENAME_LIST);
    }else{
        prtErrorMsg("비밀번호가 틀립니다.");
    }
}else{
    prtErrorMsg("잘못된 접근입니다.");
}
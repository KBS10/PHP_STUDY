<?php

if($getArrayData = dataValidation("POST", ['id', 'password'], true)) {

    loginBoard($getArrayData['id']);

    pageMove(Board_Info::FILENAME_LIST);

}else{

    pageMove(Board_Info::FILENAME_LIST);

}
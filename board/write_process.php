<?php
// POST 데이터 무결성 검사 및 HTML 태그 처리
if($getArrayData = dataValidation("POST", ['title', 'user_name', 'user_passwd', 'content'], true)) {
    // 사용자 비밀번호 암호화
    $getArrayData['user_passwd'] = password_hash($getArrayData['user_passwd'], PASSWORD_DEFAULT);

    // 게시글 DB 작성
    $result = writeArticle($getArrayData['user_name'], $getArrayData['user_passwd'], $getArrayData['title'], $getArrayData['content']);

    // 리스트 페이지 이동
    pageMove(Board_Info::FILENAME_LIST);
}else{
    prtErrorMsg("입력 값에 공란이 있습니다");
}
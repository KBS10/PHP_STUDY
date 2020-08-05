// 페이지 Redirection 함수 -> 예) "write.php" 글쓰기 페이지 이동 시 이용
function doRedirect(url){
    console.log(url);

    location.href = url;
}

function sendPostMsgList(argUrl, argData) {
    let form = document.createElement("form");
    form.action = argUrl;
    form.method = "post";

    for (let value of argData) {
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = value.name;
        input.value = value.value;
        form.appendChild(input);
        document.body.appendChild(form);
    }

    form.submit();
}
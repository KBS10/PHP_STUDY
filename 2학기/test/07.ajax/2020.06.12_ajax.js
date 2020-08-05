// XMLHttpRequest 객체 생성 <- 웹 브라우저 종류에 따라 생성 객체 상이
function getXMLHttpRequest(){
    if(window.ActiveXObject){
        // IE 6.0 이하
        return new ActiveXObject("Microsoft.XMLHTTP");
    }else if(window.XMLHttpRequest){
        // IE 7.0, IE 외 웹 브라우저
        return new XMLHttpRequest();
    }else{
        return null;
    }
}

// HTTP Request 송신 함수
function sendXMLHttpRequest(){
    // XMLHttpRequest객체 생성
    var httpReq = new XMLHttpRequest();

    // reqdy state 변화에 따른 실행 함수 정의
    httpReq.onreadystatechange = function(){
        if(httpReq.readyState == 4 && httpReq.status == 200){
            // console.log("received data : " + httpReq.responseText);
            document.getElementById("answer").innerHTML = httpReq.responseText;
        }
    }
    
    // HTTP request 속성 설정
    httpReq.open("GET", "myajax.php", true);

    // HTTP request 전송
    httpReq.send(); 

}

function exeHttpRequest(isSynchMode){
    let xmlHttpReq = new XMLHttpRequest();

    xmlHttpReq.onreadystatechange = function(){
        if(xmlHttpReq.readyState == 1){
            console.log("ready State : 1 OPENED");
        }else if(xmlHttpReq.readyState == 2){
            console.log("ready State : 2 HEADERS_RECEIVED");
        }else if(xmlHttpReq.readyState == 3){
            console.log("ready State : 3  LOADING");
        }else if(xmlHttpReq.readyState == 4){
            console.log("ready State : 4 DONE");
        }else{
            console.log("Something is wrong, write long file!!");
        }
    }
}
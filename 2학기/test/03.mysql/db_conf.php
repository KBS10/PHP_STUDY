<?php
    class db_info{
        const db_url    = "localhost";
        const user_id   = "root";
        const passwd    = "123456";
        const db        = "ycj_test";
    }
$conn = new mysqli(db_conf::db_url,
    db_conf::user_id,
    db_conf::passwd,
    db_conf::db);

    if($conn->connect_errno){
        echo "Failed to connect to MySQL: ". $conn->connect_errno;
    }

    try{
        $id     = array("ycj", "ljk", "scp", "hr");
        $name   = array("ycjung", "jklee", "scpark", "hoyrin");
        $level  = array("king", "king", "king", "queen");
        $age    = array(18, 48, 28, 20);

        for($i = 0; $i < 4; $i++){
            if(!$conn->query("insert into customer values('{$i}', '{$name[$i]}', '1234', '{$name[$i]}','{$level[$i]}', '{$age[$i]}')" ))
                throw new Exception('Myqli_query eror');
        }
    }catch (Exception $e){
        echo "시스템 에러. 미안하다. 관리자에게 연락바란다. <br>{$conn->error}";
    }
    $conn->close();
//    $res = mysqli_query($conn,"select * from customer");
//    $row = mysqli_fetch_assoc($res);
//    echo $row['name'];


//while($record = $result -> fetch_array()){
//    // 현재 검색 된 모든 레코드들을 하나씩 가져와 순회
//
//    // 현 획득된 레코드의 필드 값들을 출력
//    for($i = 0; $i < $result->field_count; $i++){
//        echo $record[$i];
//    }
//}
?>
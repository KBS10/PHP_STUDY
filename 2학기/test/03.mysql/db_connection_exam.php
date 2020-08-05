<?php
require_once('db_conf.php');
$db_conn = new mysqli(db_conf::db_url,
    db_conf::user_id,
    db_conf::passwd,
    db_conf::db);

if($db_conn->connect_errno){
    echo "Failed to connect to the MySQL Server ";
    exit(-1);
}else
    echo "Model connection is successfully established";

$sql_stmt = 'insert into customer values(4, "L1234", "12345a", "YCJUNG", "J1", 22)';

if($result = $db_conn -> query($sql_stmt))
    echo "데이터 삽입 성공 <br>";
else
    echo "데이터 삽입 실패 <br>";

$sql_stmt = 'select *from customer';

if($result = $db_conn -> query($sql_stmt)){
    while ($row = $result -> fetch_assoc()){
        echo $row['customerid'].":".$row['id'].":".$row['password']
            .":".$row['name'].":".$row['level'].":".$row['age']."<br>";
    }
}else
    echo "데이터 검색 실패<br>";
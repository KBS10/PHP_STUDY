<?php
    $receivedData = json_decode(file_get_contents('php://input'));
    $receiveMsg = null;
    class db_conf{
        const DB_URL    = "localhost";
        const USER_ID   = "root";
        const PASSWD    = "123456";
        const DB_NAME   = "ycj_test";
    }

    function dbConnection(){
        $conn = new mysqli(db_conf::DB_URL, db_conf::USER_ID, db_conf::PASSWD, db_conf::DB_NAME);
        
        if($conn->connect_errno){
            echo "Failed to connect to the MySQL Server";
            exit(-1);
        }else{
            echo "Model connection is successfully established";
        }
    }

    function insertGrade($argObj){
        $db_conn = dbConnection();

        $sql_stmt = "insert into gpa values($argObj->id, {$argObj->name} , {$argObj->courseGrade[0]} , {$argObj->courseGrade[1]}, {$argObj->courseGRade[2]}, {$argObj->sum}, {$argObj->avg})";

        if($result = $db_conn -> query($sql_stmt)){
            $db_conn->close();
            return true;
        }

        $db_conn->close();
        return false;
    }
?>
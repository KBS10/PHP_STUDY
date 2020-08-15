<?php

$sql =  "INSERT INTO " . TABLE . " (user_name, user_passwd, title, contents, reg_date) 
            VALUES ('argUserName','argUserPassword','argTitle','argContents',now())" ;

echo $sql;


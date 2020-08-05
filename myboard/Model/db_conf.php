<?php

// Model 환경 설정
class DbInfo {
    const DB_URL  = "localhost";
    const USER_ID = "root";
    const PASSWD = "1234";
    const DB_NAME = "ycj_test";
    const DB_TABLE = "mybulletin";
}

class DB_SYS_VALUE {
    const DB_FATAL_ERROR = -9999999999;
    const CONTENT_UNREGISTERED = -1;
    const CONTENT_PW_NOT_MATCHED = -2;
    const CONTENT_PW_MATCHED = 1;
}
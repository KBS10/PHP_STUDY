<?php
// Ajax response message format
class RspMsg
{
    public $cmdType, $rspStatus, $rspData;

    public function __construct($argMsgType, $argRspStatus, $argRspData)
    {
        $this->cmdType    = $argMsgType;    // Command Type
        $this->rspStatus    = $argRspStatus;   // Result of the request processing
        $this->rspData      = $argRspData;     // Data as a response message
    }
}

// Containing information of the created bingo table
class BingoTable {
    public $colNum, $numOfData, $data;

    public function __construct($argColNum, $argNumOfData, $argData)
    {
        $this->colNum       = $argColNum;       //  Number of column of the created bingo table
        $this->numOfData    = $argNumOfData;  //  Number of data in the created bingo table
        $this->data         = $argData;
    }
}

function getBingoTable()
{
    $bingoNum  = rand(5, 15);
    $numOfData = pow($bingoNum, 2);
    $bingoTable  = array();

    for ($i = 0; $i < $numOfData; $i++) {
        $flag = true;
        $tempRandValue = rand(1, $numOfData * 2);
        for ($j = 0; $j < $i; $j++) {
            if ($bingoTable[$j] == $tempRandValue) {
                $i--;
                $flag = false;
                break;
            }
        }
        if ($flag)
            $bingoTable[] = $tempRandValue;
    }
    return new BingoTable($bingoNum, $numOfData, $bingoTable);
}

// Decode JSON content to an Object
if($receivedData = json_decode(file_get_contents('php://input'))) {
    $rspMsg = null;

    // Write a response message for the received ajax message from a client
    // In this phase, we only consider single command to create bingo table.
    switch ($receivedData->cmdType) {
        case "getBingoTable": // create a new bingo table
            $rspData = getBingoTable();
            $rspMsg = new RspMsg("getBingoTable", ($rspData != null ? true : false), $rspData);
            break;
        default : // unknown command
            $rspMsg = new RspMsg("unknown", false, $receivedData->data);
            break;
    }
    // Encode to JSON format
    echo json_encode($rspMsg);
} else {
    echo "Invalid access!!";
}
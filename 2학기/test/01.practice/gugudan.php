<?php
    if(($_POST['value']) != null){
        for($ICount = 1; $ICount <=9; $ICount++){
            $SUM = $_POST['value'] * $ICount;
            echo "{$_POST['value']} * {$ICount} = {$SUM} <BR>";
        }

}else{
    for($ICount = 2; $ICount < 9; $ICount += 3){
        for($JCount = 1; $JCount < 10; $JCount++){
            for($KCount = $ICount; $KCount < $ICount+ 3; $KCount++){
                $SUM = $JCount * $KCount;
                echo "{$KCount} * {$JCount} = {$SUM} \t";
            }
            echo "<BR>";
        }
        echo "-------------------------------------<BR>";
    }
}


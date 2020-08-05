<!DOCTYPE html>
<html lang="en" xmlns:text-align="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
require_once('data_process_util.php');
$numOfData = $_POST['numOfData'];
$list = [];
// 배열에 input_process에서 넘어온 값 저장
for($iCount = 0; $iCount < $numOfData; $iCount++){
    $list[$iCount] = $_POST['value'.($iCount+1)];
}
$sum            = sum($list);
$average        = average($list);
$median         = median($list);
?>
<!--테이블 출력-->
<table border = "1" style=""text-align: center;">
<tr><th>입력 값</th>   <td><?php foreach ($list as $value) echo $value. " " ;?></td></tr>
<tr><th>총합</th>      <td><?php echo $sum;?></td></tr>
<tr><th>평균</th>      <td><?php echo $average; ?></td></tr>
<tr><th>중간 값</th>   <td><?php
        sort_bubble($list, true);
        echo $median;?></td></tr>
<tr><th>소팅 후</th>   <td><?php
        foreach ($list as $value) echo $value. " " ;?></td></tr>
</table>

</body>
</html>
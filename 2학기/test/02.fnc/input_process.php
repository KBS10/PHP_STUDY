<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="data_process.php" method="POST">
    <fieldset>
        <legend>정수 <?php echo $_POST['numOfData']?>개를 입력하시오</legend>
        <?php
        echo "<input type='hidden' name='numOfData' value ={$_POST['numOfData']}>";
        for ($i = 1; $i <= $_POST['numOfData']; $i++)
            echo "입력 값 {$i}  <input type='number' name='value{$i}'> <br>";
        ?>
        <input type="submit" value="입력하기">
    </fieldset>
</form>
</body>
</html>
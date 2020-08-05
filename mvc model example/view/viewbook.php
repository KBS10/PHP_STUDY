<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border = 1 cellspacing = 5 cellpadding = 5 bgcolor="#00ff99">
        <?php
        echo "<tr><td>Title</td><td>". $book->title ."</td></tr>";
        echo "<tr><td>Author</td><td>". $book->author ."</td></tr>";
        echo "<tr><td>Description</td><td>". $book->description ."</td></tr>";
        ?>
    </table>
</body>
</html>
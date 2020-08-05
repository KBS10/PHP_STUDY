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
    <table border = 1  cellspacing = 5 cellpadding = 5 bgcolor="#ccff99">
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>Description</td>
        </tr>
        <?php
            foreach($books as $book){
                echo '<tr><td><a href="index.php?book='.$book->title.'">'.$book->title.'</a></td>';
                echo '<td>' .$book->author.'</td>';
                echo '<td>' .$book->description.'</td></tr>';
            }
        ?>
    </table>
</body>
</html>
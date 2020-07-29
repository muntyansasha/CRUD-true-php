
<html>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="<?=$_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
    <input name="title" type="text" placeholder="Заголовок"/>
    <input name="description" type="text" placeholder="Краткое описание"/>
    <input name="details" type="text" placeholder="Полный текст"/>
    <input type="file" name="picture">
    <input type="submit" class="btn btn-primary" value="Отправить"/>
</form>
<hr>
<div class="field">
    <button name="write" class="btn btn-primary" onclick="window.location.href='posts.php'">Вся информация</button>
</div>
<?php
require_once 'connection.php';

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['details']) && isset($_FILES['picture'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $details = $_POST['details'];


    $file = $_FILES['picture']['tmp_name'];
    $filename = mt_rand(0, 10000);
    $name = $_FILES['picture']['name'].$filename;
    $path = 'images/';
    $routeToImage = $path.$name;
    if (!@copy($_FILES['picture']['tmp_name'], $routeToImage))
        echo 'Что-то пошло не так';
    else
        echo 'Загрузка удачна';

    $query = "INSERT INTO posts (title, description, details, images) VALUES ('$title','$description', '$details', '$routeToImage')";

    $mysqli->query($query);
}

?>

</body>
</html>

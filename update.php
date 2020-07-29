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
<?php
require_once 'connection.php';

$id = $_GET['id'];

$select = "SELECT * FROM posts WHERE id ='$id'";

$post = $mysqli->query($select)->fetch_assoc();

$title = $_POST['title'];
$description = $_POST['description'];
$details = $_POST['details'];


$file = $_FILES['picture']['tmp_name'];
$filename = mt_rand(0, 10000);
$name = $_FILES['picture']['name'].$filename;
$path = 'images/';
$routeToImage = $path.$name;

@copy($_FILES['picture']['tmp_name'], $routeToImage);

if (isset($title) && isset($description) && isset($details) && isset($file)){
     mysqli_query($mysqli,"UPDATE posts SET title='$title', description = '$description', details = '$details', images='$routeToImage'  WHERE id='$id' ");
     $post = $mysqli->query($select)->fetch_assoc();

     $_SESSION['message'] = "ИНФОРМАЦИЯ ОБНОВЛЕНА!";
    echo '<script>
    location.href= "/posts.php";
    alert("Данные обновлены");
    </script>';

}

?>

<form action="update.php?id=<?=$post['id']?>" method="post" enctype="multipart/form-data">
    <div class="form-group" >
        <label for="exampleInputEmail1">title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$post['title'] ?>" name="title">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">description</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?=$post['description'] ?>" name="description">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">details</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?=$post['details'] ?>" name="details">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">images</label><br>
        <img src="<?= $post['images'] ?>" class="img-thumbnail" width="200px" height="200px">
        <input type="file" name="picture">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
<?php
require_once 'connection.php';

$sql = "SELECT * FROM `posts`";
$result = $mysqli->query($sql);

for ($data = []; $row = $result->fetch_assoc(); $data[] = $row) ;

$id = $_POST['id'];
if (isset($id)){
    $query = "DELETE FROM posts WHERE id = '$id'";
    $result = $mysqli->query($query);
    echo '<script>
    location.href= "/posts.php";
    </script>';
}

?>

<table class="table">

    <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Details</th>
        <th scope="col">Images</th>
        <th scope="col">Actions</th>
        <th scope="col">Update</th>


    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $value): ?>
        <tr>
            <td><?= $value['title'] ?></td>
            <td><?= $value['description'] ?></td>
            <td><?= $value['details'] ?></td>
            <td><img src="<?= $value['images'] ?>" class="img-thumbnail" width="200px" height="200px">
            </td>
            <td>
                <form action="posts.php" method="post">
                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                    <input type="submit" value="delete" class="btn btn-danger">
                </form>
            </td>
            <td>
                <a class="btn btn-primary" href="update.php?id=<?= $value['id'] ?>">Update</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<button name="write" class="btn btn-primary" onclick="window.location.href='index.php'">Добавить запись</button>
</body>
</html>
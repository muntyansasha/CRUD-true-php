<?php

$file = $_FILES['picture']['tmp_name'];
$filename = mt_rand(0, 10000);
$name = $filename.$_FILES['picture']['name'];
$path = 'images/';
$routeToImage = $path.$name;

?>
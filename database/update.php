<?php

require './database/dbConnect.php';

$id=$_GET['id'];
$active=$_GET['active'];

if (empty($active)){
    $active = 'Y';
}

$getData = $connect->prepare("UPDATE `task` SET `active`= '$active' WHERE `id`='$id';");

$getData->execute();

header("Location: /deshbord");

?>
<?php

require './database/dbConnect.php';

$id=$_GET['id'];

$getData = $connect->prepare("DELETE FROM `task` WHERE `id`='$id';");

$getData->execute();

header("Location: /deshbord");

?>
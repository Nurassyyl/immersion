<?php
require "functions.php";
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$user_id = $_POST['id'];
$extension = pathinfo($_FILES['avatar']['name']);
$avatar = uniqid() .".". $extension['extension']; 
// var_dump($avatar); exit;
// $sql = "UPDATE `user` SET `avatar` = :avatar WHERE `id` = :user_id ";
// $statement = $pdo->prepare($sql);
// $statement->execute(['avatar' => $avatar, 'user_id' => $user_id]);
avatar_update_name($pdo, $avatar, $user_id);

$to = "uploads";
$tmp_name = $_FILES['avatar']['tmp_name'];
avatar_update($tmp_name, $to, $avatar, $extension);
header("Location: users.php");
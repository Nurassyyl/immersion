<?php 

require "functions.php";
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$user_id = $_GET['id'];
echo $user_id;

$sql = "DELETE FROM `user` WHERE `user`.`id` = :user_id ";
$statement = $pdo->prepare($sql);
$statement->execute(['user_id' => $user_id]);
logout();
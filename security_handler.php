<?php

session_start();
require "functions.php";
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$user_id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$password_confirmation = $_POST['password_confirmation'];
$hash_confirmation = password_hash($password_confirmation, PASSWORD_DEFAULT);
if ($_SESSION['user']['email'] == $email){
  security_update($pdo, $user_id, $email, $hash, $hash_confirmation);
  exit;
} 
  if (get_user_by_email($email, $pdo)['email'] == $email) {
    flash_message('login_error', 'Этот эл. адрес уже занят другим пользователем.');
  }
  else {
    security_update($pdo, $user_id, $email, $hash, $hash_confirmation);
  }




// $sql = " UPDATE `user` SET `email` = :email, `password` = :hash WHERE `user`.`id` = :user_id";
// $statement = $pdo->prepare($sql);
// $statement->execute(['email' => $email, 'hash' => $hash, 'user_id' => $user_id]);
// header('Location: users.php');
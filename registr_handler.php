<?php
require 'functions.php';

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');

$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

if (empty(get_user_by_email($email, $pdo))) {
  // add_user($email, $hash, $pdo);
  add_users($pdo, $name, $job_title, $phone, $address, $email, $hash, $role, $status, $avatar, $vk, $telegram, $instagram);
  header("Location: page_login.php");
  flash_message('login_succes', 'Регистрация успешно');
} else {
  header("Location: page_register.php");
  flash_message('login_error', 'Этот эл. адрес уже занят другим пользователем.');
  flash_message('msg', 'Уведомление');
}

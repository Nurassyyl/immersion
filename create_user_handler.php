<?php 

session_start();
require 'functions.php';
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$name = $_POST['name'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 0;
$hash = password_hash($password, PASSWORD_DEFAULT);
$status = $_POST['status'];

$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];

$extension = pathinfo($_FILES['avatar']['name']);
// $avatar = uniqid() . "." . $extension['extension'];
$tmp_name = $_FILES['avatar']['tmp_name'];
$to = 'uploads';

if (empty(get_user_by_email($email, $pdo))) {
  add_users($pdo, $name, $job_title, $phone, $address, $email, $hash, $role, $status, $avatar, $vk, $telegram, $instagram);
  avatar($tmp_name, $to, $avatar, $extension);
  flash_message('login_success', 'Профиль успешно обновлен.');
  header("Location: users.php");
} else {
  flash_message('login_error', 'Такое почта уже существует');
  header("Location: create_user.php");
}

// echo $status, $name, $job_title, $phone, $address, $email, $hash, $avatar, $vk, $telegram, $instagram;

// $sql = " INSERT INTO `user` (`id`, `name`, `job_title`, `phone`, `address`, `email`, `password`, `role`, `status`, `avatar`, `vk`, `telegram`, `instagram`) VALUES (NULL, :name, :job_title, :phone, :address, :email, :password, :role, :status, :avatar, :vk, :telegram, :instagram) ";
// $statement = $pdo->prepare($sql);
// $statement->execute([ 'name' => $name, 'job_title' => $job_title, 'phone' => $phone, 'address' => $address, 'email' => $email, 'password' => $hash, 'role' => $role, 'status' => $status, 'avatar' => $avatar, 'vk' => $vk, 'telegram' => $telegram, 'instagram' => $instagram]);

// $sql = "INSERT INTO `user` (`id`, `email`, `password`, `phone`, `address`, `email`, `password`, `online`, `img_name`, `link_vk`, `link_tw`, `link_insta`) VALUES (NULL, :name, :job) ";
// $statement = $pdo->prepare($sql);
// $statement->execute([
//   'name' => $name,
//   'job' => $job_title,
// ]);


// , :phone :address, :email, :passowrd, :status, :img_name, :link_vk, :link_tw, :link_insta
// 'email' => $email,
//   'password' => $hash,
//   'status' => $status,
//   'img_name' => $img_name,
//   'link_vk' => $vk,
//   'link_tw' => $telegram,
//   'link_insta' => $instagram
// 'phone' => $phone,
//   'address' => $address,

// $sql = " INSERT INTO `role` (`id`, `role`, `name`) VALUES (NULL, :role, :name) ";
// $statement = $pdo->prepare($sql);
// $statement->execute(['role' => $role, 'name' => $name]);
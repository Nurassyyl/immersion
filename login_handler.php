<?php

require 'functions.php';

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');

$email = $_POST['email'];
$password = $_POST['password'];

login($email, $password, $pdo);

// $users = "SELECT * FROM `users` WHERE `email` = :email ";
// $statement = $pdo->prepare($users);
// $statement->execute(['email' => $email]);
// $user = $statement->fetch(PDO::FETCH_ASSOC);
// $verify = password_verify($password, $user['password']); 
// if ($password == $verify) {
//   $_SESSION['user'] = [
//     'email' => $user['email']
//   ];
//   header("Location: page_profile.php");
// } else {
//   echo "False";
// }

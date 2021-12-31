<?php

function get_user_by_email($email, $pdo) {
  $users = "SELECT * FROM `user` WHERE `email` = :email";
  $statement = $pdo->prepare($users);
  $statement->execute(['email' => $email]);  
  return $statement->fetch(PDO::FETCH_ASSOC);
}

function add_user($email, $hash, $pdo) {
  $sql = "INSERT INTO `user` (`id`, `email`, `password`) VALUES (NULL, :email, :password) ";
  $statement = $pdo->prepare($sql);
  $statement->execute(['email' => $email, 'password' => $hash]);
}

function flash_message($key, $msg) {
  $_SESSION[$key] = $msg;
}

function login($email, $password, $pdo) {
  
  $user = get_user_by_email($email, $pdo);
  if (empty($user)) {
    flash_message('login_now', 'Такой почта не существует');
    header("Location: page_login.php");
    exit; 
  }

        if ($password == password_verify($password, $user['password'])) {
          $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'job_title' => $user['job_title'],
            'phone' => $user['phone'],
            'address' => $user['address'],
            'email' => $user['email'],
            'role' => $user['role'],
            'status' => $user['status'],
            'avatar' => $user['avatar'],
            'vk' => $user['vk'],
            'telegram' => $user['telegram'],
            'instagram' => $user['instagram']
          ];
          header("Location: users.php");
        } else {
          flash_message('password_now', 'Пароль не верный');
          header("Location: page_login.php");
        }
}

function add_users($pdo, $name, $job_title, $phone, $address, $email, $hash, $role, $status, $avatar, $vk, $telegram, $instagram) {
   $sql = " INSERT INTO `user` (`id`, `name`, `job_title`, `phone`, `address`, `email`, `password`, `role`, `status`, `avatar`, `vk`, `telegram`, `instagram`) VALUES (NULL, :name, :job_title, :phone, :address, :email, :password, :role, :status, :avatar, :vk, :telegram, :instagram) ";
   $statement = $pdo->prepare($sql);
   $statement->execute([ 'name' => $name, 'job_title' => $job_title, 'phone' => $phone, 'address' => $address, 'email' => $email, 'password' => $hash, 'role' => $role, 'status' => $status, 'avatar' => $avatar, 'vk' => $vk, 'telegram' => $telegram, 'instagram' => $instagram]);
}

function avatar($tmp_name, $to, $avatar, $extension) {
  $avatar = uniqid() . "." . $extension['extension'];
  $tmp_name = $_FILES['avatar']['tmp_name'];
  $to = 'uploads';
  move_uploaded_file($tmp_name, "$to/$avatar");
}

function logout() {
  unset($_SESSION['user']);
  header("Location: page_login.php");
}

function edit_users($pdo, $user_id) {
  $sql = "SELECT * FROM `user` WHERE `id` = :user_id";
  $statement = $pdo->prepare($sql);
  $statement->execute(['user_id' => $user_id]);
  return $statement->fetch(PDO::FETCH_ASSOC);
}

function update_users($pdo, $user_id, $name, $job_title, $phone, $address) {
  $sql = "UPDATE `user` SET `name` = :name, `job_title` = :job_title, `phone` = :phone, `address` = :address WHERE `user`.`id` = :user_id ";
  $statement = $pdo->prepare($sql);
  $statement->execute(['name' => $name, 'job_title' => $job_title, 'phone' => $phone, 'address' => $address, 'user_id' => $user_id]);
  header("Location: users.php");
  // flash_message('update_success', '')
}

function security($pdo, $user_id) {
  $sql = "SELECT * FROM `user` WHERE `id` = :user_id ";
  $statement = $pdo->prepare($sql);
  $statement->execute(['user_id' => $user_id]);
  return $statement->fetch(PDO::FETCH_ASSOC);
}

function security_update($pdo, $user_id, $email, $hash, $hash_confirmation) {
  $sql = " UPDATE `user` SET `email` = :email, `password` = :hash WHERE `user`.`id` = :user_id";
  $statement = $pdo->prepare($sql);
  $statement->execute(['email' => $email, 'hash' => $hash, 'user_id' => $user_id]);
  header('Location: users.php');
}

function avatar_update_name($pdo, $avatar, $user_id) {
  $sql = "UPDATE `user` SET `avatar` = :avatar WHERE `id` = :user_id ";
  $statement = $pdo->prepare($sql);
  $statement->execute(['avatar' => $avatar, 'user_id' => $user_id]);
}

function avatar_update($tmp_name, $to, $avatar, $extension) {
  move_uploaded_file($tmp_name, "$to/$avatar");
}

function update_status($pdo, $status, $user_id) {
  $sql = "UPDATE `user` SET `status` = :status WHERE `user`.`id` = :user_id";
  $statement = $pdo->prepare($sql);
  $statement->execute(['status' => $status, 'user_id' => $user_id]);
  header("Location: users.php");
}
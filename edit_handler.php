<?php

require "functions.php";
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$user_id = $_POST['id'];
$name = $_POST['name'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];
update_users($pdo, $user_id, $name, $job_title, $phone, $address);
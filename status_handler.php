<?php 

require "functions.php";
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$user_id = $_POST['id'];
$status = $_POST['status'];
update_status($pdo, $status, $user_id);

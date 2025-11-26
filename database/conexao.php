<?php
require_once('../envs.php');
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
try {
    $pdo = new PDO($host, $user, $pass);
} catch (Exception $e) {
    die("Error:".$e->getMessage());
} ?>
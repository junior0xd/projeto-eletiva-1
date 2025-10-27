<?php
$host = "mysql:host=localhost;dbname=projeto_estoque";
$user = "root";
$pass = "8rj0cAWniS9sVWpH#";

try {
    $pdo = new PDO($host, $user, $pass);
} catch (Exception $e) {
    die("Error:".$e->getMessage());
}
?>
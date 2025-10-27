<?php
$host = "mysql:host=localhost;dbname=projeto_estoque";
$user = "code";
$pass = "vscode123";

try {
    $pdo = new PDO($host, $user, $pass);
} catch (Exception $e) {
    die("Error:".$e->getMessage());
}
?>
<?php
session_start();
if (empty($_SESSION['acesso'])) {
    header('Location: login.php?notloggedin=true');
    exit();
} 
if (isset($_SESSION['ultimo_acesso'])) {
    $tempo_limite = 30 * 60; // 30 minutos em segundos
    //testado e funcionando
    if (time() - $_SESSION['ultimo_acesso'] > $tempo_limite) {
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['ultimo_acesso'] = time();
    }
}
?>
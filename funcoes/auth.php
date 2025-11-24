<?php
session_start();
session_regenerate_id(true);
if (empty($_SESSION['acesso'])) {
    header('Location: login.php?nao_logado=true');
    exit();
} 
if (isset($_SESSION['ultimo_acesso'])) {
    $tempo_limite = 10 * 60; // 10 minutos em segundos
    //testado e funcionando
    if (time() - $_SESSION['ultimo_acesso'] > $tempo_limite) {
        session_unset();
        session_destroy();
        header('Location: login.php?sessao_expirada=true');
        exit();
    } else {
        $_SESSION['ultimo_acesso'] = time();
    }
}
?>
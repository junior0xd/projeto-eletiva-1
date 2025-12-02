<?php
class Auth{
    public static function gerar_token_csrf() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verificar_token_csrf($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function limpar_token_csrf() {
        unset($_SESSION['csrf_token']);
    }
    public static function verificar_sessao_ativa($tempo_limite = 1800) {
        if (empty($_SESSION['ultimo_acesso']) || (time() - $_SESSION['ultimo_acesso']) > $tempo_limite) {
            session_unset();
            session_destroy();
            header('Location: index.php?sessao_expirada=true');
            exit();
        }
        $_SESSION['ultimo_acesso'] = time();
    }
    public static function verificar_usuario_admin() {
        if (empty($_SESSION['cargo']) || $_SESSION['cargo'] !== 60) {
            http_response_code(403);
            include('../public_html/forbidden.php');
            exit();
        }
    }
    public static function verificar_autorizacao() {
        $cargos_permitidos = [intval(getenv('ROLE_ADMIN')),
         intval(getenv('ROLE_USER'))];
        if (empty($_SESSION['cargo']) || !in_array($_SESSION['cargo'], $cargos_permitidos)) {
            http_response_code(403);
            include('../public_html/forbidden.php');
            exit();
        }
    }
    public static function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>
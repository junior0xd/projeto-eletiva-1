<?php
require('../funcoes/sessao.php');
require('../funcoes/security-headers.php');
require('../funcoes/auth.php');
Auth::verificar_sessao_ativa();
define('IN_APP', true);
require('head-navbar.php');
function cargo_string($cargo_int): string {
    switch ($cargo_int) {
        case 60:
            return 'Administrador';
        case 1:
            return 'Usuário';
        default:
            return 'Desconhecido';
    }
}
?>
<main class="container d-flex flex-column justify-content-center align-items-start">
    <h1 class="mt-3 mb-0 fs-4 fw-medium ">Perfil do Usuário</h1>
    <hr class="mt-n3 border border-secondary opacity-75 w-100">
    <div class="row">
        <div class="col-auto">
            <label for="nome">Nome</label>
            <input class="form-control" type="text" id="nome" value="<?= htmlspecialchars($_SESSION['nome_usuario'] ?? '') ?>" disabled readonly>
        </div>
        <div class="col-auto">
            <label for="cadastro">Cadastro</label>
            <input class="form-control" type="text" id="cadastro" value="<?= htmlspecialchars($_SESSION['cadastro_usuario'] ?? '') ?>" disabled readonly>
        </div>
        <div class="col-auto">
            <label for="cargo">Cargo</label>
            <input class="form-control" type="text" id="cargo" value="<?=   htmlspecialchars(cargo_string($_SESSION['cargo'] ?? '')) ?>" disabled readonly>
        </div>
    </div>
</main>
<?php require('footer.php'); ?>
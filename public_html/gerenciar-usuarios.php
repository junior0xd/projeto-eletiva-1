<?php
require('../funcoes/sessao.php');
require('../funcoes/authorization.php');
require('../database/conexao.php');
require('../funcoes/security-headers.php');
require('../funcoes/auth.php');
require('../funcoes/usuarios.php');
Auth::verificar_sessao_ativa();
Auth::verificar_usuario_admin();
define('IN_APP', true);
$gerenciar_usuarios = new Usuario($pdo);
require('head-navbar.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario_id = intval($_POST['usuario_id']);
    $novo_cargo = intval($_POST['novo_cargo']);
    $gerenciar_usuarios->atualizar_cargo_usuario($usuario_id, $novo_cargo);
}
$usuarios = $gerenciar_usuarios->recuperar_usuarios();
?>
<main>
    <div class="container border mt-3 rounded-2 w">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Cadastro</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['cadastro'])?></td>
                        <td><?= htmlspecialchars($usuario['nome']); ?></td>
                        <td><?= htmlspecialchars($usuario['cargo']); ?></td>
                        <td>
                            <form action="gerenciar-usuarios.php" method="post" class="d-inline">
                                <input type="hidden" name="usuario_id" value="<?= $usuario['id']; ?>">
                                <select name="novo_cargo" class="form-select d-inline w-auto align-self-end">
                                    <option value="1" <?= $usuario['cargo'] == 1 ? 'selected' : '' ?>>Usuário</option>
                                    <option value="60" <?= $usuario['cargo'] == 60 ? 'selected' : '' ?>>Administrador</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Alterar Cargo</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require('footer.php'); ?>

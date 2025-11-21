<?php
require('../funcoes/auth.php');
require('../database/conexao.php');
require('../funcoes/echo-out.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_produto = $_POST['nome_produto'];
    $quantidade_produto = $_POST['quantidade_produto'];
    $categoria_produto = $_POST['categoria_produto'];
    try {
        $stmt_checar = $pdo->prepare("SELECT COUNT(*) FROM produto WHERE nome = :nome_produto");
        $stmt_checar->bindParam(":nome_produto", $nome_produto, PDO::PARAM_STR);
        $stmt_checar->execute();
        $contador = $stmt_checar->fetchColumn();
        if ($contador > 0) {
            //O produto já existe no estoque
            $produto_existe = true;
        } else {
            $stmt = $pdo->prepare("INSERT INTO produto (nome, quantidade, categoria_id) VALUES (?, ?, ?)");
            if ($stmt->execute([$nome_produto, $quantidade_produto, $categoria_produto])) {
                $produto_adicionado = true;
            }
        }
    } catch (Exception $e) {
        echo ("Ocorreu um erro ao adicionar um novo produto: " . $e->getMessage());
    }
}
require('../funcoes/produtos.php');
$gerenciar_produtos = new Produto($pdo);
$produtos = $gerenciar_produtos->recuperar_produtos();
$categorias = $gerenciar_produtos->recuperar_categorias();
require('head-navbar.php');
?>
<main class="container w-100 mt-4">
    <div class="row">
        <div class="offset-lg-10 offset-md-8 offset-8 col-lg-2 mt-3 col-md-4 col-4 d-flex justify-content-center">
            <a href="add-item.php" class="btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#adicionar_produtos">Novo Item</a>
        </div>
        <?php require('modal_produtos.php') ?>
    </div>
    <form>
        <div class="row justify-content-center">
            <?php if ($produto_existe) {
                echoAlertaWarning("Produto já existe no estoque");
            } ?>
            <div class="col-6 col-md-8 col-lg-10">
                <div class="input-group text-white mt-2">
                    <span class="input-group-text">
                        <svg class="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                    <input type="text" class="form-control fw-medium" placeholder="Procurar..." name="produto_procurado" id="produto_procurado">
                </div>
            </div>
            <div class="col-auto mt-2">
                <button class="btn btn-outline-light ms-0" type="submit">Buscar</button>
                <input class="btn btn-outline-info ms-1" type="button" value="Filtros" data-bs-toggle="collapse" data-bs-target="#filtros">
            </div>
            <div class="collapse" id="filtros">
                <div class=" offset-sm-8 card card-body mt-3 bg-black bg-opacity-10 border-secondary">
                    <form action="">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Tipo</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="switchEnfermagem" id="switchEnfermagem">
                                            <label class="form-check-label" for="switchEnfermagem">
                                                Enfermagem
                                            </label>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" role="switch" name="checkboxVencidos" id="checkboxVencidos">
                                            <label class="form-check-label" for="checkboxVencidos">
                                                Vencidos
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="switchEscritorio" id="switchEscritorio">
                                            <label for="switchEscritorio">
                                                Escritório
                                            </label>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" role="switch" name="checkboxBaixoEstoque" id="checkboxBaixoEstoque">
                                            <label class="form-check-label" for="checkboxBaixoEstoque">
                                                Baixo Estoque
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" role="switch" name="checkboxProximosVencimento" id="checkboxProximosVencimento">
                                            <label class="form-check-label" for="checkboxProximosVencimento">
                                                Próximos a vencer
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-info align-self-end">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
    </form>
    <div class="container border mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produtos)) {?>
                    <tr><td colspan='4' class='fs-5 fw-normal'>Nenhum produto cadastrado</td></tr>
                <?php } ?>
                <?php foreach ($produtos as $prod): ?>
                    <tr>
                        <td><?= $prod['id']; ?></td>
                        <td><?= $prod['nome']; ?></td>
                        <td><?= $prod['descricao']; ?></td>
                        <td><?= $prod['quantidade']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require('footer.php'); ?>
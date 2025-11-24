<?php
require('../funcoes/sessao.php');
require('../funcoes/auth.php');
Auth::verificar_sessao_ativa();
define('IN_APP', true);
require('../database/conexao.php');
require('../funcoes/echo-out.php');
require('../funcoes/produtos.php');
$gerenciar_produtos = new Produto($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = $_POST['produto_id'];
    $nome_produto = $_POST['nome_produto'];
    $quantidade_produto = $_POST['quantidade_produto'];
    $categoria_produto = $_POST['categoria_produto'];
    $validade_produto = $_POST['validade_produto'];
    $tipo_solicitacao = $_POST['tipo_solicitacao'];
    if($tipo_solicitacao === 'criar'){
        $adicionou_produto = $gerenciar_produtos->adicionar_produto(
        nome: $nome_produto, 
        quantidade: $quantidade_produto, 
        categoria: $categoria_produto,
        validade: $validade_produto);
    } elseif ($tipo_solicitacao == 'atualizar'){
        $atualizou_produto = $gerenciar_produtos->atualizar_produto(
            id: $produto_id,
            nome: $nome_produto, 
            quantidade: $quantidade_produto, 
            categoria: $categoria_produto,
            validade: $validade_produto);
    }

}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $item_procurado = $_GET['produto_procurado'];
    $vencidos = isset($_GET['checkboxVencidos']);
    if($vencidos){
        $vencido_check = 'checked';
    }
    $proximos_vencimento = isset($_GET['checkboxProximosVencimento']);
    if ($proximos_vencimento){
        $proximovenc_check = 'checked';
    }
    $baixo_estoque = isset($_GET['checkboxBaixoEstoque']);
    if($baixo_estoque){
        $baixo_check = 'checked';
    }
    $filtro_enfermagem = isset($_GET['switchEnfermagem']);
    $filtro_escritorio = isset($_GET['switchEscritorio']);
    // monta opções e filtros
    $opcoes = [
        'item_procurado' => $item_procurado,
        'vencidos' => $vencidos,
        'proximos' => $proximos_vencimento,
        'baixo' => $baixo_estoque,
    ]; 
    if($filtro_enfermagem && !$filtro_escritorio){
        $enf_check = 'checked';
        $produtos = $gerenciar_produtos->recuperar_produtos(filtro_tipo:'ENFERMAGEM', opcoes: $opcoes);
    } elseif ($filtro_escritorio && !$filtro_enfermagem){
        $esc_check = 'checked';
        $produtos = $gerenciar_produtos->recuperar_produtos(filtro_tipo:'ESCRITORIO', opcoes: $opcoes);
    } else {
        $enf_check = 'checked';
        $esc_check = 'checked';
        $produtos = $gerenciar_produtos->recuperar_produtos(filtro_tipo:'TODOS', opcoes: $opcoes);
    }
} else {
    $produtos = $gerenciar_produtos->recuperar_produtos(filtro_tipo:'TODOS');
}
$categorias = $gerenciar_produtos->recuperar_categorias();
require('head-navbar.php');
?>
<main class="container w-100 mt-4">
    <div class="row">
        <div class="offset-lg-10 offset-md-8 offset-8 col-lg-2 mt-3 col-md-4 col-4 d-flex justify-content-center">
            <button class="btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#adicionar_produtos">Novo Item</button>
        </div>
        <?php require('modal_produtos.php'); ?>
    </div>
    <form>
        <div class="row justify-content-center">
            <?php if ($adicionou_produto === 3) {
                echoAlertaWarning(
                    mensagem: "Produto já existe no estoque",
                    classes: "alert alert-dismissible alert-warning d-flex align-items-center mb-2 mt-2 col-auto");
            } elseif ($adicionou_produto === 1){
                echoSucesso(
                    mensagem:"Produto adicionado com sucesso",
                    classes:"alert alert-dismissible alert-success d-flex align-items-center mb-2 mt-2 col-auto");
            } elseif ($atualizou_produto === 1){
                echoSucesso(
                    mensagem:"Produto atualizado com sucesso",
                    classes:"alert alert-dismissible alert-success d-flex align-items-center mb-2 mt-2 col-auto");
            }?>
            <div class="col-6 col-md-8 col-lg-10">
                <div class="input-group text-white mt-2">
                    <span class="input-group-text">
                        <svg class="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                    <input type="search" class="form-control fw-medium" placeholder="Procurar..." name="produto_procurado" id="produto_procurado">
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
                                            <input <?= $enf_check ?> class="form-check-input" type="checkbox" role="switch" name="switchEnfermagem" id="switchEnfermagem">
                                            <label class="form-check-label" for="switchEnfermagem">
                                                Enfermagem
                                            </label>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input <?= $vencido_check ?> class="form-check-input" type="checkbox" role="switch" name="checkboxVencidos" id="checkboxVencidos">
                                            <label class="form-check-label" for="checkboxVencidos">
                                                Vencidos
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check form-switch">
                                            <input <?= $esc_check ?> class="form-check-input" type="checkbox" role="switch" name="switchEscritorio" id="switchEscritorio">
                                            <label for="switchEscritorio">
                                                Escritório
                                            </label>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input <?= $baixo_check ?> class="form-check-input" type="checkbox" role="switch" name="checkboxBaixoEstoque" id="checkboxBaixoEstoque">
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
                                            <input <?= $proximovenc_check ?> class="form-check-input" type="checkbox" role="switch" name="checkboxProximosVencimento" id="checkboxProximosVencimento">
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
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Validade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produtos)) {?>
                    <tr><td colspan='4' class='fs-5 fw-normal'>Nenhum produto cadastrado</td></tr>
                <?php } ?>
                <?php foreach ($produtos as $prod): ?>
                    <tr>
                        <td><?= htmlspecialchars($prod['nome']); ?></td>
                        <td><?= $prod['quantidade']; ?></td>
                        <td><?= $prod['data_validade']; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#detalheProduto" detalhe-produto='<?= json_encode($prod) ?>'>Detalhes</button>
                            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarProduto" detalhe-produto='<?= json_encode($prod) ?>'>Editar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include('modal_editar_produto.php'); ?>
    </div>
    <?php include('modal_detalhe_produto.php'); ?>
</main>
<?php require('footer.php'); ?>
<script>
document.getElementById('detalheProduto').addEventListener('show.bs.modal', (e) => {
    const produto = JSON.parse(e.relatedTarget.getAttribute('detalhe-produto'));
    document.getElementById('detalheNome').textContent = produto.nome;
    document.getElementById('detalheQuantidade').textContent = produto.quantidade;
    document.getElementById('detalheValidade').textContent = produto.data_validade;
    document.getElementById('detalheCategoria').textContent = produto.categoria_nome;
    });
document.getElementById('editarProduto').addEventListener('show.bs.modal', (e) => {
    const produto = JSON.parse(e.relatedTarget.getAttribute('detalhe-produto'));
    document.getElementById('editarNomeProduto').textContent = `Editando: ${produto.nome}`;
    document.getElementById('editarProdutoId').value = produto.id;
    document.getElementById('editarNomeProduto2').value = produto.nome;
    document.getElementById('editarValidadeProduto').value = produto.data_validade_iso;
    document.getElementById('editarQuantidadeProduto').value = produto.quantidade;
    });
</script>

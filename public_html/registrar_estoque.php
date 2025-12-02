<?php
require('../funcoes/sessao.php');
require('../database/conexao.php');
require('../funcoes/security-headers.php');
require('../funcoes/auth.php');
Auth::verificar_sessao_ativa();
Auth::verificar_autorizacao();
define('IN_APP', true);
require('../funcoes/echo-out.php');
require('../funcoes/produtos.php');
require('head-navbar.php');
$gerenciar_produtos = new Produto($pdo);
$produtos = $gerenciar_produtos->recuperar_produtos(filtro_tipo: 'TODOS');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $produtos_ids = $_POST['produtos'];
    $quantidades = $_POST['quantidades'];
    $action = $_POST['action'];
    foreach($produtos_ids as $index => $produto_id){
        $quantidade = intval($quantidades[$index]);
        if($quantidade > 0){
            if ($action === 'entrada') {
                $produto_atualizado = $gerenciar_produtos->atualizar_quantidade_entrada($produto_id, $quantidade);
            } elseif ($action === 'saida') {
                $produto_atualizado = $gerenciar_produtos->atualizar_quantidade_saida($produto_id, $quantidade);
            }
        }
    }
}
?>
<main class="container mt-3">
    <?php if($produto_atualizado == 1) echoSucesso(mensagem: "Estoque atualizado com sucesso!"); ?>
    <ul class="nav nav-tabs" id="tabsRegistrar">
        <li>
            <button class="nav-link active" id="tabEntrada" data-bs-toggle="tab" data-bs-target="#painelEntrada" aria-selected="true" role="tab">Entrada</button>
        </li>
        <li>
            <button class="nav-link" id="tabSaida" data-bs-toggle="tab" data-bs-target="#painelSaida">Saída</button>
        </li>
    </ul>
    <div class="tab-content" id="tabsConteudo">
        <div class="tab-pane active show" id="painelEntrada">
            <form action="registrar_estoque.php" method="post">
                <div class="mb-2">
                    <label class="mt-3" for="registrarEntradaProduto">Item</label>
                    <input type="hidden" name="action" value="entrada">
                    <select class="form-select" name="produtoId" id="registrarEntradaProduto">
                        <option disabled selected hidden value="">Selecione...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= htmlspecialchars($produto['id']) ?>"><?= htmlspecialchars($produto['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <h5 class="text-center mt-4">Items Selecionados</h5>
                    <div id="selecionadosContainer" class="mt-3 border rounded-2">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success align-self-center">Registrar Entrada</button>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="painelSaida">
            <form action="registrar_estoque.php" method="post">
                <div class="mb-2">
                    <input type="hidden" name="action" value="saida">
                    <label class="mt-3" for="registrarSaidaProduto">Item</label>
                    <select class="form-select" name="produtoId" id="registrarSaidaProduto">
                        <option disabled selected hidden value="">Selecione...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= htmlspecialchars($produto['id']) ?>"><?= htmlspecialchars($produto['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <h5 class="text-center mt-4">Items Selecionados</h5>
                    <div id="selecionadosContainerSaida" class="mt-3 border rounded-2">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger align-self-center">Registrar Saída</button>
                </div>
            </form>

        </div>
    </div>
</main>
<?php
require('footer.php');
?>
<script src="libs/registrar_estoque.js"></script>
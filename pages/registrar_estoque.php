<?php
require('../funcoes/sessao.php');
require('../funcoes/auth.php');
Auth::verificar_sessao_ativa();
define('IN_APP', true);
require('../database/conexao.php');
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
            <button class="nav-link" id="tabEntrada" data-bs-toggle="tab" data-bs-target="#painelEntrada">Entrada</button>
        </li>
        <li>
            <button class="nav-link" id="tabSaida" data-bs-toggle="tab" data-bs-target="#painelSaida">Saída</button>
        </li>
    </ul>
    <div class="tab-content" id="tabsConteudo">
        <div class="tab-pane" id="painelEntrada">
            <form action="registrar_estoque.php" method="post">
                <div class="mb-2">
                    <label for="registrarEntradaProduto">Item</label>
                    <input type="hidden" name="action" value="entrada">
                    <select class="form-select" name="produtoId" id="registrarEntradaProduto">
                        <option disabled selected hidden value="">Selecione...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
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
                    <label for="registrarSaidaProduto">Item</label>
                    <select class="form-select" name="produtoId" id="registrarSaidaProduto">
                        <option disabled selected hidden value="">Selecione...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
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
<script>
    function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}
$(document).ready(function() {
    //entrada de produtos
    $("#registrarEntradaProduto").select2({
        theme: "bootstrap-5",
        matcher: matchCustom,
        placeholder: 'Selecione...',
        allowClear: true,
        width: '100%'
    });

    $('#registrarEntradaProduto').on('select2:select', function(e) {
        const data = e.params.data;
        const id = data.id;
        const texto = data.text;

        // desabilita a opção para evitar re-seleção na lista (Select2 respeita disabled)
        $(this).find('option[value="' + id + '"]').prop('disabled', true);
        $(this).trigger('change.select2');

        // cria a div com hidden input do produto e campo de quantidade se ainda não existir
        if ($('#item-' + id).length === 0) {
            const container = $('<div>', { id: 'item-' + id, 'data-id': id, class: 'd-flex align-items-center m-2 gap-2' });
            // hidden para enviar id do produto
            container.append($('<input>', { type: 'hidden', name: 'produtos[]', value: id }));
            // nome do produto
            container.append($('<div>', { class: 'flex-grow-1' }).text(texto));
            // input quantidade
            container.append($('<input>', { type: 'number', name: 'quantidades[]', class: 'form-control', min: 0, value: 0, style: 'width:7.5rem' }));
            // botão remover
            container.append($('<button>', { type: 'button', class: 'btn btn-sm btn-secondary btn-remover' }).html("<?= iconeLixeiraJquery() ?>"));
            $('#selecionadosContainer').append(container);
        }
    });

    // quando um item for desmarcado via Select2 (unselect): reabilita opção e remove div
    $('#registrarEntradaProduto').on('select2:unselect', function(e) {
        const id = e.params.data.id;
        $(this).find('option[value="' + id + '"]').prop('disabled', false);
        $(this).trigger('change.select2');
        $('#item-' + id).remove();
    });

    // botão remover dentro do container: atualiza o select2 e reabilita opção
    $('#selecionadosContainer').on('click', '.btn-remover', function() {
        const div = $(this).closest('div[id^="item-"]');
        const id = div.data('id').toString();
        const select = $('#registrarEntradaProduto');

        // atualiza valores do select2 removendo o id
        const valores = select.val() || [];
        const novos = valores.filter(v => v !== id);
        select.val(novos).trigger('change');

        // reabilita a opção no select e remove a div
        select.find('option[value="' + id + '"]').prop('disabled', false);
        select.trigger('change.select2');
        div.remove();
    });

    //saida de produtos
    $("#registrarSaidaProduto").select2({
        theme: "bootstrap-5",
        matcher: matchCustom,
        placeholder: 'Selecione...',
        allowClear: true,
        width: '100%'
    });

    $('#registrarSaidaProduto').on('select2:select', function(e) {
        const data = e.params.data;
        const id = data.id;
        const texto = data.text;

        // desabilita a opção para evitar re-seleção na lista (Select2 respeita disabled)
        $(this).find('option[value="' + id + '"]').prop('disabled', true);
        $(this).trigger('change.select2');

        // cria a div com hidden input do produto e campo de quantidade se ainda não existir
        if ($('#item-' + id).length === 0) {
            const container = $('<div>', { id: 'item-' + id, 'data-id': id, class: 'd-flex align-items-center m-2 gap-2' });
            // hidden para enviar id do produto
            container.append($('<input>', { type: 'hidden', name: 'produtos[]', value: id }));
            // nome do produto
            container.append($('<div>', { class: 'flex-grow-1' }).text(texto));
            // input quantidade
            container.append($('<input>', { type: 'number', name: 'quantidades[]', class: 'form-control', min: 0, value: 0, style: 'width:7.5rem' }));
            // botão remover
            container.append($('<button>', { type: 'button', class: 'btn btn-sm btn-secondary btn-remover' }).html("<?= iconeLixeiraJquery() ?>"));
            $('#selecionadosContainerSaida').append(container);
        }
    });

    // quando um item for desmarcado via Select2 (unselect): reabilita opção e remove div
    $('#registrarSaidaProduto').on('select2:unselect', function(e) {
        const id = e.params.data.id;
        $(this).find('option[value="' + id + '"]').prop('disabled', false);
        $(this).trigger('change.select2');
        $('#item-' + id).remove();
    });

    // botão remover dentro do container: atualiza o select2 e reabilita opção
    $('#selecionadosContainerSaida').on('click', '.btn-remover', function() {
        const div = $(this).closest('div[id^="item-"]');
        const id = div.data('id').toString();
        const select = $('#registrarSaidaProduto');

        // atualiza valores do select2 removendo o id
        const valores = select.val() || [];
        const novos = valores.filter(v => v !== id);
        select.val(novos).trigger('change');

        // reabilita a opção no select e remove a div
        select.find('option[value="' + id + '"]').prop('disabled', false);
        select.trigger('change.select2');
        div.remove();
    });

    
});
</script>
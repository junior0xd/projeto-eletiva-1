<?php
require('../funcoes/auth.php');
require('../database/conexao.php');
require('head-navbar.php');
require('../funcoes/produtos.php');
$gerenciar_produtos = new Produto($pdo);
$produtos = $gerenciar_produtos->recuperar_produtos(filtro_tipo: 'TODOS');
?>
<main class="container mt-3">
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
                    <select class="form-select" name="produtoId" id="registrarEntradaProduto">
                        <option disabled selected hidden value="">Selecione...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
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

$("#registrarEntradaProduto").select2({
    theme: "bootstrap-5",
    matcher: matchCustom
});
</script>
<?php
if (!defined('IN_APP')) {
    http_response_code(403);
    exit('Acesso proibido');
}
?>
<div class="modal fade" id="editarProduto" tabindex="-1" aria-labelledby="editarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarNomeProduto">Placeholder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="estoque.php" method="post">
                    <input type="hidden" name="tipo_solicitacao" value="atualizar">
                    <input type="hidden" id="editarProdutoId" name="produto_id" value="">
                    <div class="mb-2">
                        <label for="nome_produto" class="col-form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="editarNomeProduto2" name="nome_produto">
                    </div>
                    <div class="mb-2">
                        <label for="quantidade_produto" class="col-form-label">Quantidade</label>
                        <input type="number" class="form-control" id="editarQuantidadeProduto" name="quantidade_produto">
                    </div>
                    <div class="mb-2">
                        <label for="validade_produto" class="col-form-label">Validade</label>
                        <input type="date" class="form-control" id="editarValidadeProduto" name="validade_produto">
                    </div>
                    <div class="mb-2">
                        <label for="categoria_produto">Categoria</label>
                        <select class="form-select" name="categoria_produto" id="categoria_produto">
                            <option disabled selected hidden value="" >Selecione...</option>
                            <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar Produto</button>
                </div>
            </form>
        </div>
    </div>
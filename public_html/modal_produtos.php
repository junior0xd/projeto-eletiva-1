<?php
if (!defined('IN_APP')) {
    http_response_code(403);
    include('../pages/forbidden.php');
    exit();
}
?>
<div class="modal fade" id="adicionar_produtos" tabindex="-1" aria-labelledby="adicionar_produtos_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adicionar_produtos_label">Adicionar Novo Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="estoque.php<?= $parametros_get ?>" method="post">
                    <input type="hidden" name="tipo_solicitacao" value="criar">
                    <div class="mb-2">
                        <label for="nome_produto" class="col-form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="nome_produto" name="nome_produto" required>
                    </div>
                    <div class="mb-2">
                        <label for="quantidade_produto" class="col-form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade_produto" name="quantidade_produto" required>
                    </div>
                    <div class="mb-2">
                        <label for="validade_produto" class="col-form-label">Validade</label>
                        <input type="date" class="form-control" id="validade_produto" name="validade_produto">
                    </div>
                    <div class="mb-2">
                        <label for="categoria_produto">Categoria</label>
                        <select class="form-select" name="categoria_produto" id="categoria_produto" required>
                            <option disabled selected hidden value="" >Selecione...</option>
                            <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= htmlspecialchars($categoria['id']) ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-4 mb-3">
                        <h2 class="fw-medium fs-6">Opcionais</h2>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="mostrar_descricao" id="mostrar_descricao">
                            <label for="mostrar_descricao" >Adicionar descrição?</label>
                            <span class="d-inline-flex" style="color:cadetblue" data-bs-toggle="tooltip" data-bs-placement="top" title="Descrição detalhada do produto."><?php iconeInfo(); ?></span>
                        </div>
                        <div hidden class="mb-2" id="div_descricao_produto">
                            <label for="descricao_produto" class="col-form-label">Descrição</label>
                            <textarea class="form-control" id="descricao_produto" name="descricao_produto" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="mostrar_quantidade_min" id="mostrar_quantidade_min">
                            <label for="mostrar_quantidade_min" >Definir quantidade mínima?</label>
                            <span class="d-inline-flex" style="color:cadetblue" data-bs-toggle="tooltip" data-bs-placement="top" title="Quantidade mínima para alerta de estoque baixo."><?php iconeInfo(); ?></span>
                        </div>
                        <div hidden class="mb-2" id="div_qtd_min_produto">
                            <label for="quantidade_min_produto" class="col-form-label">Quantidade Mínima</label>
                            <input type="number" class="form-control" id="quantidade_min_produto" name="quantidade_min_produto" value="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
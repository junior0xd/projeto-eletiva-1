<?php
if (!defined('IN_APP')) {
    http_response_code(403);
    include('../pages/forbidden.php');
    exit();
}
?>
<div class="modal fade" id="detalheProduto" tabindex="-1" aria-labelledby="detalheProdutoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col">
                        <h5 class="modal-title fw-bold" id="detalheProdutoLabel">Detalhes: <span class="fs-5 fw-light" id="detalheNomeProduto">Placeholder</span></h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <span id="detalheDescricao">Placeholder</span>
                </div>
                <div class="mb-2">
                    <strong>Quantidade:</strong>
                    <span id="detalheQuantidade">0</span>
                </div>
                <div class="mb-2">
                    <strong>Validade:</strong>
                    <span id="detalheValidade">00/00/0000</span>
                </div>
                <div class="mb-2">
                    <strong>Categoria:</strong>
                    <span id="detalheCategoria">Placeholder</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
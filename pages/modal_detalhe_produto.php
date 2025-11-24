<?php
if (!defined('IN_APP')) {
    http_response_code(403);
    exit('Acesso proibido');
}
?>
<div class="modal fade" id="detalheProduto" tabindex="-1" aria-labelledby="detalheProdutoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalheNome">Placeholder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
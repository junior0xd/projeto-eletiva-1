<div class="modal fade" id="adicionar_produtos" tabindex="-1" aria-labelledby="adicionar_produtos_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adicionar_produtos_label">Adicionar Novo Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="landpage.php" method="post">
                    <div class="mb-2">
                        <label for="nome_produto" class="col-form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="nome_produto" name="nome_produto" required>
                    </div>
                    <div class="mb-2">
                        <label for="quantidade_produto" class="col-form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade_produto" name="quantidade_produto" required>
                    </div>
                    <div class="mb-2">
                        <label for="categoria_produto">Categoria</label>
                        <select class="form-select" name="categoria_produto" id="categoria_produto">
                            <option>Selecione...</option>
                            <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
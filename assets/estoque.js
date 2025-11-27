document.getElementById('detalheProduto').addEventListener('show.bs.modal', (e) => {
    const produto = JSON.parse(e.relatedTarget.getAttribute('detalhe-produto'));
    if (produto.categoria_id === 1){
        produto.categoria = 'Enfermagem';
    } else if (produto.categoria_id === 2){
        produto.categoria = 'Escritório';
    } else {
        produto.categoria = 'Desconhecida';
    }
    document.getElementById('detalheNomeProduto').textContent = produto.nome;
    console.log(produto);
    document.getElementById('detalheQuantidade').textContent = produto.quantidade;
    document.getElementById('detalheValidade').textContent = produto.data_validade;
    document.getElementById('detalheCategoria').textContent = produto.categoria;
    });
document.getElementById('editarProduto').addEventListener('show.bs.modal', (e) => {
    const produto = JSON.parse(e.relatedTarget.getAttribute('detalhe-produto'));
    document.getElementById('editarNomeProduto').textContent = produto.nome;
    document.getElementById('editarProdutoId').value = produto.id;
    document.getElementById('editarNomeProduto2').value = produto.nome;
    document.getElementById('editarValidadeProduto').value = produto.data_validade_iso;
    document.getElementById('editarQuantidadeProduto').value = produto.quantidade;
    });
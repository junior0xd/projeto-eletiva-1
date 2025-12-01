document.getElementById('detalheProduto').addEventListener('show.bs.modal', (e) => {
    const produto = JSON.parse(e.relatedTarget.getAttribute('detalhe-produto'));
    if (produto.categoria_id === 1){
        produto.categoria = 'Enfermagem';
    } else if (produto.categoria_id === 2){
        produto.categoria = 'Escritório';
    } else {
        produto.categoria = 'Desconhecida';
    }
    if (produto.data_validade === null || produto.data_validade === '0000-00-00'){
        produto.data_validade = 'Indeterminado';
    }
    if (produto.descricao === null || produto.descricao.trim() === ''){
        produto.descricao = 'Sem descrição disponível.';
    }
    document.getElementById('detalheNomeProduto').textContent = produto.nome;
    document.getElementById('detalheQuantidade').textContent = produto.quantidade;
    document.getElementById('detalheDescricao').innerHTML = `<strong>Descrição:</strong> ${produto.descricao}`;
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
document.getElementById('mostrar_quantidade_min').addEventListener('change', (e) => {
    const divElement = document.getElementById('div_qtd_min_produto');
    if (e.target.checked) {
        divElement.removeAttribute('hidden');
    } else {
        divElement.setAttribute('hidden', 'true');
    }
});
document.getElementById('mostrar_descricao').addEventListener('change', (e) => {
    const divElement = document.getElementById('div_descricao_produto');
    if (e.target.checked) {
        divElement.removeAttribute('hidden');
    } else {
        divElement.setAttribute('hidden', 'true');
    }
});
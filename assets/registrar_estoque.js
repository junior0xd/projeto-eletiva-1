   var iconeLixeira = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/></svg>";
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
            container.append($('<button>', { type: 'button', class: 'btn btn-sm btn-secondary btn-remover' }).html(iconeLixeira));
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
            container.append($('<button>', { type: 'button', class: 'btn btn-sm btn-secondary btn-remover' }).html(iconeLixeira));
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
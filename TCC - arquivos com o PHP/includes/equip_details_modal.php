<?php
/* Include: Modal para exibir detalhes do equipamento
   - Usado em páginas Admin
   - Espera receber botões com data-* attributes:
     data-descricao, data-numero-serie, data-marca, data-local, data-disponivel, data-tipo-nome, data-numeracao
*/
?>

<!-- Modal de Detalhes do Equipamento -->
<div class="modal fade" id="equipDetailsModal" tabindex="-1" aria-labelledby="equipDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="equipDetailsModalLabel">Detalhes do Equipamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tipo / Numeração:</strong> <span id="equipTipoNumeracao"></span></p>
                <p><strong>Marca:</strong> <span id="equipMarca"></span></p>
                <p><strong>Local:</strong> <span id="equipLocal"></span></p>
                <p><strong>Número de Série:</strong> <span id="equipNumeroSerie"></span></p>
                <p><strong>Descrição:</strong></p>
                <p id="equipDescricao" class="small text-muted"></p>
                <p><strong>Disponível:</strong> <span id="equipDisponivel"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Popula modal de detalhes a partir dos atributos data-* do botão
(function() {
    var modal = document.getElementById('equipDetailsModal');
    if (!modal) return;
    modal.addEventListener('show.bs.modal', function(e) {
        var button = e.relatedTarget;
        if (!button) return;
        var tipoNome = button.getAttribute('data-tipo-nome') || '';
        var numeracao = button.getAttribute('data-numeracao') || '';
        var marca = button.getAttribute('data-marca') || '';
        var local = button.getAttribute('data-local') || '';
        var numeroSerie = button.getAttribute('data-numero-serie') || '';
        var descricao = button.getAttribute('data-descricao') || '';
        var disponivel = button.getAttribute('data-disponivel') === '1' ? 'Sim' : 'Não';

        var set = function(id, value) {
            var el = document.getElementById(id);
            if (el) el.textContent = value;
        };
        set('equipTipoNumeracao', tipoNome + (numeracao ? ' #' + numeracao : ''));
        set('equipMarca', marca);
        set('equipLocal', local);
        set('equipNumeroSerie', numeroSerie);
        set('equipDescricao', descricao);
        set('equipDisponivel', disponivel);
    });
})();
</script>

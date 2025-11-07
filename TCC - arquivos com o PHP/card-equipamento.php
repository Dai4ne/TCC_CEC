<div class="product-card shadow-sm">
    <div class="product-card-img">
        <img src="<?= htmlspecialchars($img) ?>" alt="Imagem do equipamento">
    </div>
    <p class="card-text text-uppercase fw-bold mb-1"><?= htmlspecialchars($marca) ?></p>
    <p class="card-text text-uppercase small mb-3"><?= htmlspecialchars($num) ?></p>
    <?php
    // Mostrar botão EMPRESTAR apenas para TVs (tipo '1') e quando disponível
    if (isset($equipamentos['tipo']) && $equipamentos['tipo'] === '1'):
        if (!isset($equipamentos['disponivel']) || $equipamentos['disponivel']): ?>
            <form method="post">
                <input type="hidden" name="id_equipamento" value="<?= $equipamentos['id_equipamento'] ?>">
                <button type="submit" name="emprestar" class="btn btn-primary w-100">EMPRESTAR</button>
            </form>
        <?php else: ?>
            <button type="button" class="btn btn-secondary w-100" disabled>INDISPONÍVEL</button>
        <?php endif; 
    endif; ?>
</div>

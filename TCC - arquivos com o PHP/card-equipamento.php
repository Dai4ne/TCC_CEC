<div class="product-card shadow-sm">
    <div class="product-card-img">
        <img src="<?= htmlspecialchars($img) ?>" alt="Imagem do equipamento">
    </div>
    <p class="card-text text-uppercase fw-bold mb-1"><?= htmlspecialchars($marca) ?></p>
    <p class="card-text text-uppercase small mb-3"><?= htmlspecialchars($num) ?></p>
    <?php if (!isset($equipamentos['disponivel']) || $equipamentos['disponivel']): ?>
        <form method="POST" action="../process_emprestimo.php">
            <input type="hidden" name="id_equipamento" value="<?= intval($equipamentos['id_equipamento']) ?>">
            <input type="hidden" name="qtd_aulas" value="1">
            <input type="hidden" name="data_devolucao" value="">
            <button type="submit" class="btn btn-primary w-100">EMPRESTAR</button>
        </form>
    <?php else: ?>
        <button class="btn btn-secondary w-100" disabled>INDISPONÍVEL</button>
    <?php endif; ?>
</div>

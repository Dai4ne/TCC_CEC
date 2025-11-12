<div class="product-card shadow-sm">
    <div class="product-card-img">
        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars(getTipoEquipamento($tipo)) ?>">
    </div>
    <p class="card-text text-uppercase fw-bold mb-1"><?= htmlspecialchars($marca) ?></p>
    <p class="card-text text-uppercase small mb-3"><?= htmlspecialchars($num) ?></p>
    <?php 
    // Dados do equipamento
    $idEquip = intval($equipamentos['id_equipamento']);

    // Verificar se existe empréstimo pendente ou em uso para este equipamento
    $estado = 'emp'; // emp = disponível, solicitado, indisponivel
    if ($stmtChk = $con->prepare("SELECT id_emprestimo, id_usuario, status_emprestimo FROM emprestimo WHERE id_equipamento = ? AND status_emprestimo IN ('P','A') LIMIT 1")) {
        $stmtChk->bind_param('i', $idEquip);
        if ($stmtChk->execute()) {
            $resChk = $stmtChk->get_result();
            if ($resChk && $rowChk = $resChk->fetch_assoc()) {
                if ($rowChk['status_emprestimo'] === 'A') {
                    $estado = 'indisponivel';
                } elseif ($rowChk['status_emprestimo'] === 'P') {
                    if (intval($rowChk['id_usuario']) === intval($_SESSION['id_usuario'])) {
                        $estado = 'solicitado';
                    } else {
                        $estado = 'indisponivel';
                    }
                }
            }
        }
        $stmtChk->close();
    }
    ?>

    <?php if ($estado === 'emp'): ?>
        <form method="POST" action="../process_emprestimo.php">
            <input type="hidden" name="id_equipamento" value="<?= $idEquip ?>">
            <input type="hidden" name="qtd_aulas" value="1">
            <input type="hidden" name="data_devolucao" value="">
            <button type="submit" class="btn btn-primary w-100">EMPRESTAR</button>
        </form>
    <?php elseif ($estado === 'solicitado'): ?>
        <button class="btn btn-warning w-100" disabled>SOLICITADO</button>
    <?php else: ?>
        <button class="btn btn-secondary w-100" disabled>INDISPONÍVEL</button>
    <?php endif; ?>
</div>

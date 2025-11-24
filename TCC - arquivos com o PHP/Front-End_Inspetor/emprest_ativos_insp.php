<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}
$perfil_verifica = '3';
include(__DIR__ . '/../verifica.php');
include __DIR__ . '/../Front-End_Admin/conect.php';
/*
 * emprest_ativos_insp.php
 * - Propósito: listar empréstimos ativos e atrasados para os inspetores monitorarem os equipamentos.
 * - Fluxo:
 *   1) Verifica sessão e perfil.
 *   2) Executa consulta que junta `emprestimo`, `usuario`, `equipamento`, `marca` e `local`.
 *   3) Traduz o campo `tipo` do equipamento para uma string legível e popula `$emprestimos_ativos`.
 * - Observações:
 *   - A página usa o status do empréstimo para destacar empréstimos atrasados (`T`).
 */
// Consulta empréstimos ativos (status 'A' = em uso, 'T' = atrasado)
$emprestimos_ativos = [];
$sqlAtivos = "SELECT e.*, u.nome as nome_professor, eq.tipo, eq.numeracao, m.nome as marca, l.nome as local_nome
              FROM emprestimo e
              JOIN usuario u ON e.id_usuario = u.id_usuario
              JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
              JOIN marca m ON eq.id_marca = m.id_marca
              LEFT JOIN `local` l ON eq.id_local = l.id_local
              WHERE e.status_emprestimo IN ('A','T')
              ORDER BY e.data_devolucao ASC";
$resAt = $con->query($sqlAtivos);
if ($resAt) {
    while ($r = $resAt->fetch_assoc()) {
        // traduzir tipo para nome legível (seguindo padrão do projeto)
        $tipos = [
            '1' => 'Televisão',
            '2' => 'Notebook',
            '3' => 'Chromebook',
            '4' => 'Tablet',
            '5' => 'Projetor',
            '6' => 'Fone'
        ];
        $r['tipo_nome'] = $tipos[$r['tipo']] ?? 'Desconhecido';
        $emprestimos_ativos[] = $r;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="header_insp.css">
    <title>CEC</title>
    

    <style>
        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3b82f6;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
        }

        .main-content {
            padding: 2rem 0;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            background-color: #e5e7eb;
        }


        .requests-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
            margin-right: 10px;
        }


        .table thead th {
            background: var(--medium-gray);
            border: none;
            text-align: center;
        }


        .table tbody td {
            text-align: center;
            vertical-align: middle;
        }


        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-md-3">
                    <div class="logo-container">
                        <img src="../Imagens/logo-png.png" alt="logo">
                    </div>
                </div>
                <div class="col-6 col-md-9">
                    <div class="nav-icons justify-content-end">
                        <a href="home_insp.php">
                            <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div> 
                        </a> <!-- HOMEPAGE-->

                        <a href="nova_notificacao_insp.php">
                            <div class="nav-icon"><i class="bi bi-pencil-square"></i></div> 
                        </a> <!-- CRIAR NOTIFICAÇÃO-->

                        <a href="solicitacao_insp.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- NOTIFICAÇÕES E SOLICITAÇÕES-->   

                        <a href="atrasos_insp.php">
                            <div class="nav-icon"><i class="bi bi-exclamation-circle-fill"></i></div>
                        </a> <!-- ATRASOS -->

                        <a href="emprest_ativos_insp.php">
                            <div class="nav-icon"><i class="bi bi-clock-history"></i></div>
                        </a> <!-- EMPRÉSTIMOS ATIVOS -->

                        <a href="equipamentos_insp.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a> <!-- EQUIPAMENTOS -->

                        <a href="perfil_insp.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!-- PERFIL-->

                        <a href="config_termos_insp.php">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> 
                        </a> <!-- CONFIGURAÇÕES-->

                    </div>
                </div>
            </div>
        </div>
    </header>

    <h1 class="page-title p-4">EMPRÉSTIMOS ATIVOS</h1>

    <main class="main-content container-fluid">


        <div class="requests-table table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Aparelho</th>
                        <th>Marca</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($emprestimos_ativos)): ?>
                        <?php foreach ($emprestimos_ativos as $ea): ?>
                            <?php
                                // Determina status e classes visuais
                                $statusLabel = '';
                                $badgeClass = 'bg-secondary';
                                $rowClass = '';
                                if (isset($ea['status_emprestimo'])) {
                                    if ($ea['status_emprestimo'] === 'T') {
                                        $statusLabel = 'ATRASADO';
                                        $badgeClass = 'bg-danger';
                                        $rowClass = 'table-danger';
                                    } elseif ($ea['status_emprestimo'] === 'A') {
                                        $statusLabel = 'Em uso';
                                        $badgeClass = 'bg-success';
                                    } else {
                                        $statusLabel = htmlspecialchars($ea['status_emprestimo']);
                                    }
                                }
                            ?>
                            <tr class="<?= $rowClass ?>">
                                <td><?php echo htmlspecialchars($ea['nome_professor']); ?></td>
                                <td style="text-align:left"><?php echo htmlspecialchars($ea['tipo_nome'] . ' #' . ($ea['numeracao'] ?? '')); ?></td>
                                <td><?php echo htmlspecialchars($ea['marca']); ?></td>
                                <td><?php echo htmlspecialchars($ea['local_nome'] ?? 'Sem localização'); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($ea['data_hora'] ?? $ea['data_devolucao'] ?? '')); ?></td>
                                <td><?php echo date('H:i', strtotime($ea['data_hora'] ?? $ea['data_devolucao'] ?? '')); ?></td>
                                <td><span class="badge <?= $badgeClass ?> rounded-pill"><?php echo $statusLabel; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum empréstimo ativo no momento.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
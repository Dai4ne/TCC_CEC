<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$perfil_verifica = '3';
include('../verifica.php');
include "../Front-End_Admin/conect.php";

// Processar ações de aprovar/rejeitar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['id_emprestimo'])) {
        $id_emprestimo = intval($_POST['id_emprestimo']);
        $action = $_POST['action'];

        if ($action === 'aprovar' || $action === 'rejeitar') {
            $status = ($action === 'aprovar') ? 'A' : 'R'; // A = Aprovado, R = Rejeitado

            // Obter id_equipamento ligado a essa solicitação
            $stmtSel = $con->prepare("SELECT id_equipamento FROM emprestimo WHERE id_emprestimo = ? LIMIT 1");
            $stmtSel->bind_param("i", $id_emprestimo);
            $id_equipamento = null;
            if ($stmtSel->execute()) {
                $resSel = $stmtSel->get_result();
                if ($resSel && $row = $resSel->fetch_assoc()) {
                    $id_equipamento = intval($row['id_equipamento']);
                }
            }
            $stmtSel->close();

            // Iniciar transação para atualizar empréstimo e disponibilidade do equipamento
            $con->begin_transaction();
            $ok = true;

            $stmt = $con->prepare("UPDATE emprestimo SET status_emprestimo = ? WHERE id_emprestimo = ?");
            $stmt->bind_param("si", $status, $id_emprestimo);
            if (!$stmt->execute()) {
                $ok = false;
            }
            $stmt->close();

            if ($ok && $id_equipamento !== null) {
                if ($status === 'A') {
                    // marcar equipamento como indisponível
                    $stmtEq = $con->prepare("UPDATE equipamento SET disponivel = 0 WHERE id_equipamento = ?");
                } else {
                    // rejeitado -> garantir que equipamento fique disponível
                    $stmtEq = $con->prepare("UPDATE equipamento SET disponivel = 1 WHERE id_equipamento = ?");
                }
                $stmtEq->bind_param("i", $id_equipamento);
                if (!$stmtEq->execute()) {
                    $ok = false;
                }
                $stmtEq->close();
            }

            if ($ok) {
                $con->commit();
                $_SESSION['msg_alert'] = ['success', 'Solicitação ' . ($status === 'A' ? 'aprovada' : 'rejeitada') . ' com sucesso!'];
            } else {
                $con->rollback();
                $_SESSION['msg_alert'] = ['error', 'Erro ao processar solicitação!'];
            }

            header("Location: solicitacao_insp.php");
            exit;
        }
    }
}

// Buscar solicitações pendentes
$sql = "SELECT e.*, u.nome as nome_professor, eq.tipo, eq.numeracao, m.nome as marca
        FROM emprestimo e
        JOIN usuario u ON e.id_usuario = u.id_usuario
        JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
        JOIN marca m ON eq.id_marca = m.id_marca
        WHERE e.status_emprestimo = 'P'
        ORDER BY e.data_hora ASC";

$resultado = $con->query($sql);
$solicitacoes = [];

if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        // Formatar tipo de equipamento
        $tipos = [
            '1' => 'Televisão',
            '2' => 'Notebook',
            '3' => 'Chromebook',
            '4' => 'Tablet',
            '5' => 'Projetor',
            '6' => 'Fone'
        ];
        $row['tipo_nome'] = $tipos[$row['tipo']] ?? 'Desconhecido';
        $solicitacoes[] = $row;
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
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }


        .requests-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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


        .btn-reject {
            background: #e74c3c;
            color: white;
            border-radius: 6px;
            padding: 6px 15px;
            border: none;
        }


        .btn-approve {
            background: #27ae60;
            color: white;
            border-radius: 6px;
            padding: 6px 15px;
            border: none;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>

<body>

    <?php include '../alert/alert.php' ?>
    
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

                        <a href="solicitacao_insp.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- SOLICITAÇÕES -->

                        <a href="equipamentos_insp.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a> <!-- EQUIPAMENTOS -->

                        <a href="atrasos_insp.php">
                            <div class="nav-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                        </a> <!-- ATRASOS -->

                        <a href="perfil_insp.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!-- PERFIL-->

                        <a href="">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> 
                        </a> <!-- CONFIGURAÇÕES-->

                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content container-fluid">
        <h1 class="page-title">SOLICITAÇÕES</h1>

        <div class="requests-table table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Aparelho</th>
                        <th>Aulas</th>
                        <th>Data de Devol. Prevista</th>
                        <th>Solicitado em</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($solicitacoes)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Nenhuma solicitação pendente</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($solicitacoes as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['nome_professor']) ?></td>

                                <td><?= htmlspecialchars($s['tipo_nome']) ?> <?= htmlspecialchars($s['marca']) ?> #<?= htmlspecialchars($s['numeracao']) ?></td>

                                <td><?= htmlspecialchars($s['qtd_aulas'] ?? '—') ?></td>

                                <td><?= date('d/m/Y H:i', strtotime($s['data_devolucao'])) ?></td>

                                <td><?= date('d/m/Y H:i', strtotime($s['data_hora'])) ?></td>
                                
                                <td class="action-buttons">
                                    <form method="post" style="display:inline-block;">
                                        <input type="hidden" name="id_emprestimo" value="<?= $s['id_emprestimo'] ?>">
                                        <input type="hidden" name="action" value="aprovar">
                                        <button type="submit" class="btn btn-approve"><i class="bi bi-check-lg"></i> Aceitar</button>
                                    </form>
                                    <form method="post" style="display:inline-block; margin-left:8px;">
                                        <input type="hidden" name="id_emprestimo" value="<?= $s['id_emprestimo'] ?>">
                                        <input type="hidden" name="action" value="rejeitar">
                                        <button type="submit" class="btn btn-reject"><i class="bi bi-x-lg"></i> Negar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
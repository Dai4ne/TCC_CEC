<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$perfil_verifica = '2';
include('../verifica.php');
   
/*
 * home_prof.php
 * - Propósito: dashboard do professor que mostra notificações, empréstimos atuais/pendentes
 *   e permite ações como devolução de equipamento.
 * - Fluxo principal:
 *   - Verifica autenticação e perfil.
 *   - Processa ações POST (ex: devolução) com transação para manter consistência.
 *   - Busca notificações recentes e os empréstimos do usuário atual (P/A/T).
 * - Observações de integridade:
 *   - A devolução atualiza o status do empréstimo e também a disponibilidade do equipamento
 *     dentro de uma transação (`begin_transaction` / `commit` / `rollback`).
 */

// Para exibir o nome
$nomeUsuario = $_SESSION['nome_usuario'];
// Conexão com o banco (para listar empréstimos do professor)
include "../Front-End_Admin/conect.php";

// Processar ação de devolver (feita pelo professor na home)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'devolver' && isset($_POST['id_emprestimo'])) {
        $idEmp = intval($_POST['id_emprestimo']);
        $idUser = intval($_SESSION['id_usuario']);

        // Obter id_equipamento associado ao empréstimo para atualizar disponibilidade
        $stmtSel = $con->prepare("SELECT id_equipamento FROM emprestimo WHERE id_emprestimo = ? AND id_usuario = ? LIMIT 1");
        if ($stmtSel) {
            $stmtSel->bind_param('ii', $idEmp, $idUser);
            $stmtSel->execute();
            $res = $stmtSel->get_result();
            $idEquip = null;
            if ($res && $row = $res->fetch_assoc()) {
                $idEquip = intval($row['id_equipamento']);
            }
            $stmtSel->close();
        } else {
            $idEquip = null;
        }

        // Iniciar transação para marcar devolução e disponibilizar equipamento
        $con->begin_transaction();
        $ok = true;

        $update = $con->prepare("UPDATE emprestimo SET status_emprestimo = 'D', data_devolucao = NOW() WHERE id_emprestimo = ? AND id_usuario = ?");
        if ($update) {
            $update->bind_param('ii', $idEmp, $idUser);
            if (!$update->execute()) {
                $ok = false;
            }
            $update->close();
        } else {
            $ok = false;
        }

        if ($ok && $idEquip !== null) {
            $stmtEq = $con->prepare("UPDATE equipamento SET disponivel = 1 WHERE id_equipamento = ?");
            if ($stmtEq) {
                $stmtEq->bind_param('i', $idEquip);
                if (!$stmtEq->execute()) {
                    $ok = false;
                }
                $stmtEq->close();
            } else {
                $ok = false;
            }
        }

            

        if ($ok) {
            $con->commit();
            $_SESSION['msg_alert'] = ['success', 'Equipamento devolvido com sucesso.'];
        } else {
            $con->rollback();
            $_SESSION['msg_alert'] = ['error', 'Erro ao processar devolução.'];
        }

        header('Location: home_prof.php');
        exit;
    }
}

// Buscar notificações do professor logado (últimas 8) e contar não-lidas
$notificacoes = [];
$notificacoes_nao_lidas = 0;
if (isset($_SESSION['id_usuario'])) {
    $idUsuario = intval($_SESSION['id_usuario']);
    $sqlN = "SELECT n.*, u.nome as remetente_nome FROM notificacao n LEFT JOIN usuario u ON n.id_remetente = u.id_usuario WHERE n.id_destinatario = ? ORDER BY n.data_envio DESC LIMIT 8";
    if ($stmtN = $con->prepare($sqlN)) {
        $stmtN->bind_param('i', $idUsuario);
        $stmtN->execute();
        $resN = $stmtN->get_result();
        while ($rowN = $resN->fetch_assoc()) {
            $notificacoes[] = $rowN;
            if (isset($rowN['status_notificacao']) && $rowN['status_notificacao'] === 'P') {
                $notificacoes_nao_lidas++;
            }
        }
        $stmtN->close();
    }
}

// Buscar empréstimos do usuário (solicitados e aceitos)
$emprestados = [];
if (isset($_SESSION['id_usuario'])) {
    $idUsuario = intval($_SESSION['id_usuario']);
    // Atualizar empréstimos que estão em uso ('A') e já passaram do horário de devolução para 'T' (atrasado)
    if ($stmtUpd = $con->prepare("UPDATE emprestimo SET status_emprestimo = 'T' WHERE id_usuario = ? AND status_emprestimo = 'A' AND data_devolucao < CURRENT_TIMESTAMP")) {
        $stmtUpd->bind_param('i', $idUsuario);
        $stmtUpd->execute();
        $stmtUpd->close();
    }
    $sql = "SELECT e.*, eq.tipo, eq.numeracao, m.nome as marca
            FROM emprestimo e
            JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
            JOIN marca m ON eq.id_marca = m.id_marca
            WHERE e.id_usuario = ? AND e.status_emprestimo IN ('P','A','T')
            ORDER BY e.data_hora DESC";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $res = $stmt->get_result();
        $tipos = [
            '1' => 'Televisão',
            '2' => 'Notebook',
            '3' => 'Chromebook',
            '4' => 'Tablet',
            '5' => 'Projetor',
            '6' => 'Fone'
        ];
        while ($row = $res->fetch_assoc()) {
            $row['tipo_nome'] = $tipos[$row['tipo']] ?? 'Desconhecido';
            $emprestados[] = $row;
        }
        $stmt->close();
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
    <link rel="stylesheet" href="header_prof.css">
    <title>CEC</title>

    <style>
        body::-webkit-scrollbar {
            display: none;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 2rem;
            margin-bottom: 2rem;
            color: #000000ff;
            text-align: center;
        }

        .dashboard-card {
            height: 400px;
            background: #e5e7eb;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px #0000000d;
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.24);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000000ff;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Limita a lista dentro do card para evitar overflow e melhora legibilidade */
        .dashboard-card .list-group {
            max-height: 300px; /* mais espaço para itens maiores */
            overflow-y: auto;
            padding-right: 6px; /* espaço para scrollbar */
        }

        .dashboard-card .list-group-item {
            overflow: visible; /* permitir crescer em altura */
            align-items: flex-start;
            background: transparent; /* já definido inline, manter coerência */
            padding: .65rem .75rem;
        }

        /* Tornar o título maior e permitir quebra em várias linhas para ler nomes longos */
        .dashboard-card .fw-bold {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
            max-width: calc(100% - 80px); /* reserva espaço para o badge */
            word-break: break-word;
            line-height: 1.2;
        }

        .dashboard-card .list-group-item .text-muted {
            display: block;
            margin-top: 4px;
            font-size: 0.87rem;
            color: #6b7280;
        }

        /* Badges um pouco menores para não consumir tanto espaço horizontal */
        .dashboard-card .badge {
            font-size: 0.75rem;
            padding: 5px 8px;
        }

        @media (max-width:768px) {
            .welcome-title {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }

            .dashboard-card {
                padding: 20px;
                margin-bottom: 15px;
            }
        }

        @media (max-width:576px) {
            .welcome-title {
                font-size: 1.5rem;
                text-align: center;
            }

            .dashboard-card {
                padding: 15px;
            }
            /* em telas pequenas permitir que o texto quebre em mais de uma linha */
            .dashboard-card .list-group-item, .dashboard-card .list-group-item .fw-bold {
                white-space: normal;
                max-width: 100%;
                font-size: 0.98rem;
            }
        }
    </style>
</head>

<body>
    <?php 
    include '../alert/alert.php'
    ?>
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

                        <a href="home_prof.php">
                            <div class="nav-icon"> <i class="bi bi-house-door-fill"></i></div>
                        </a> <!--HOMEPAGE-->

                        <a href="equipamentos_prof.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a><!--EQUIPAMENTOS-->

                        <a href="notificacao_prof.php" style="position:relative;">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i>
                            <?php if (!empty($notificacoes_nao_lidas)): ?>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="top:6px;right:6px;font-size:0.65rem;"><?= intval($notificacoes_nao_lidas) ?></span>
                            <?php endif; ?>
                            </div>
                        </a> <!-- NOTIFICAÇÕES -->

                        <a href="historico_prof.php">
                            <div class="nav-icon"><i class="bi bi-clock-history"></i></div>
                        </a> <!--HISTÓRICO-->

                        <a href="perfil_prof.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!--PERFIL-->

                        <a href="config_termos_prof.php">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> 
                        </a> <!-- CONFIGURAÇÕES-->

                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <h1 class="welcome-title">BEM-VINDO, <?= strtoupper(htmlspecialchars($nomeUsuario)); ?>!</h1>
                </div>
            </div>

            <div class="row justify-content-center">

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-bell-fill me-2"></i>NOTIFICAÇÃO</h2>
                        <?php if (empty($notificacoes)): ?>
                            <p class="text-center" style="margin-top:18px;">Nenhuma notificação recente</p>
                        <?php else: ?>
                            <div class="list-group" style="margin-top:10px;">
                                <?php foreach ($notificacoes as $n): ?>
                                    <?php
                                        $status = (isset($n['status_notificacao']) && $n['status_notificacao'] === 'P') ? ['texto' => 'Nova', 'classe' => 'bg-primary'] : ['texto' => 'Lida', 'classe' => 'bg-secondary'];
                                        $remetente = !empty($n['remetente_nome']) ? htmlspecialchars($n['remetente_nome']) : 'Sistema';
                                    ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-start mb-2" style="background:#fff;border-radius:8px;">
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars(mb_strimwidth($n['mensagem'], 0, 80, '...')) ?></div>
                                            <small class="text-muted">De: <?= $remetente ?> • <?= date('d/m H:i', strtotime($n['data_envio'])) ?></small>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="badge <?= $status['classe'] ?> rounded-pill" style="height:26px;padding:5px 8px;align-self:center;"><?= $status['texto'] ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-laptop-fill me-2"></i>EMPRESTADOS</h2>
                        <?php if (empty($emprestados)): ?>
                            <p class="text-center" style="margin-top:18px;">Nenhum aparelho solicitado ou emprestado</p>
                        <?php else: ?>
                            <div class="list-group" style="margin-top:10px;">
                                <?php foreach ($emprestados as $item): ?>
                                                                <?php
                                                                // Mapear status para rótulos exibidos
                                                                if ($item['status_emprestimo'] === 'P') {
                                                                    $statusLabel = 'Solicitado';
                                                                    $badgeClass = 'bg-warning text-dark';
                                                                } elseif ($item['status_emprestimo'] === 'A') {
                                                                    // 'A' representará 'Em uso' para o professor
                                                                    $statusLabel = 'Em uso';
                                                                    $badgeClass = 'bg-success';
                                                                } elseif ($item['status_emprestimo'] === 'T') {
                                                                    // 'T' = Atrasado
                                                                    $statusLabel = 'Em atraso';
                                                                    $badgeClass = 'bg-danger';
                                                                } else {
                                                                    $statusLabel = $item['status_emprestimo'];
                                                                    $badgeClass = 'bg-secondary';
                                                                }
                                                                ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-start mb-2" style="background:#fff;border-radius:8px;">
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($item['tipo_nome']) ?> <?= htmlspecialchars($item['marca']) ?> #<?= htmlspecialchars($item['numeracao']) ?></div>
                                            <small class="text-muted">Solicitado em <?= date('d/m/Y H:i', strtotime($item['data_hora'])) ?></small>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="badge <?= $badgeClass ?> rounded-pill" style="height:28px;padding:6px 10px;align-self:center;"><?= $statusLabel ?></span>
                                            <?php if ($item['status_emprestimo'] === 'A' || $item['status_emprestimo'] === 'T'): // mostrar botão devolver quando estiver em uso ou em atraso ?>
                                                <form method="post" style="margin-top:6px;">
                                                    <input type="hidden" name="id_emprestimo" value="<?= intval($item['id_emprestimo']) ?>">
                                                    <input type="hidden" name="action" value="devolver">
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Devolver</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../script.js"></script>
</html>
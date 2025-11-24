<?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit;
    }

    $perfil_verifica = '1';
    include('../verifica.php');

    /*
     * home_admin.php
     * - Propósito: página inicial do administrador com resumo rápido (notificações e
     *   empréstimos ativos) para monitoramento.
     * - Queries principais:
     *   - Seleciona as últimas notificações direcionadas ao admin (limit 8) para exibição.
     *   - Seleciona empréstimos com status ativo/atrasado, juntando dados de equipamento,
     *     marca, usuário e local para mostrar detalhes no painel.
     * - Observações:
     *   - Ambas as consultas usam prepared statements (ou prepared SQL) e retornam arrays
     *     que são iterados para renderizar os cards da dashboard.
     */


    // Para exibir o nome
    $nomeUsuario = $_SESSION['nome_usuario'];
    // Conexão com o banco
    include __DIR__ . '/conect.php';

    // Buscar notificações direcionadas ao admin
    $notificacoes = [];
    $idLogado = intval($_SESSION['id_usuario']);
    if ($stmtN = $con->prepare("SELECT n.*, u.nome as remetente_nome FROM notificacao n JOIN usuario u ON n.id_remetente = u.id_usuario WHERE n.id_destinatario = ? ORDER BY n.data_envio DESC LIMIT 8")) {
        $stmtN->bind_param('i', $idLogado);
        $stmtN->execute();
        $resN = $stmtN->get_result();
        while ($r = $resN->fetch_assoc()) {
            $notificacoes[] = $r;
        }
        $stmtN->close();
    }

    // Buscar empréstimos ativos (equipamentos sendo usados no momento)
    $emprestimosAtivos = [];
        $sql = "SELECT e.id_emprestimo, e.id_equipamento, e.data_hora, e.data_devolucao, e.status_emprestimo, eq.tipo, eq.numeracao, m.nome as marca, u.nome as usuario_nome, l.nome as local_nome
            FROM emprestimo e
            JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
            JOIN marca m ON eq.id_marca = m.id_marca
            LEFT JOIN `local` l ON eq.id_local = l.id_local
            JOIN usuario u ON e.id_usuario = u.id_usuario
            WHERE e.status_emprestimo IN ('A','T')
            ORDER BY e.data_hora DESC";
    if ($stmtE = $con->prepare($sql)) {
        $stmtE->execute();
        $resE = $stmtE->get_result();
        $tipos = [
            '1' => 'Televisão',
            '2' => 'Notebook',
            '3' => 'Chromebook',
            '4' => 'Tablet',
            '5' => 'Projetor',
            '6' => 'Fone'
        ];
        while ($row = $resE->fetch_assoc()) {
            $row['tipo_nome'] = $tipos[$row['tipo']] ?? 'Desconhecido';
            $emprestimosAtivos[] = $row;
        }
        $stmtE->close();
    }
    ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="header_admin.css">
    <title>CEC</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Federo&family=Poppins&display=swap');

        html, body{
            height: 100%;
            margin: 0px;
            padding: 0;
            overflow-x: hidden;
        }

        body::-webkit-scrollbar {
            display: none;
            margin: 0;
            background: #f8f9fa;
            font-family: Poppins, Arial;
        }

        h1 {
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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

        @media (max-width:768px) {
            h1 {
                font-size: 1.6rem;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width:576px) {
            h1 {
                font-size: 1.4rem;
            }

            th,
            td {
                padding: .4rem;
                font-size: .8rem;
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


                        <a href="home_admin.php">
                            <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div>
                        </a> <!-- HOMEPAGE-->

                        <a href="equip_televisao_admin.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a> <!-- EQUIPAMENTOS -->

                        <a href="cadastros_admin.php">
                            <div class="nav-icon"><i class="bi bi-plus-square-fill"></i></div>
                        </a> <!-- CADASTRAR -->

                        <a href="notificacao_admin.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- NOTIFICAÇÕES -->

                        <a href="nova_notificacao_admin.php">
                            <div class="nav-icon"><i class="bi bi-pencil-square"></i></div> 
                        </a> <!-- CRIAR NOTIFICAÇÃO-->

                        <a href="perfil_admin.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!-- PERFIL-->

                        <a href="config_termos_admin.php">
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
                        <h2 class="card-title"><i class="bi bi-bell-fill me-2"></i>NOTIFICAÇÕES</h2>
                        <ul class="list-group">
                            <?php if (!empty($notificacoes)): ?>
                                <?php foreach ($notificacoes as $n): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><?php echo htmlspecialchars($n['remetente_nome']); ?></div>
                                            <small class="text-muted"><?php echo nl2br(htmlspecialchars($n['mensagem'])); ?></small>
                                        </div>
                                        <span class="badge bg-secondary rounded-pill"><?php echo date('d/m H:i', strtotime($n['data_envio'])); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">Nenhuma notificação.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-clock-history me-2"></i>Empréstimos ativos</h2>
                        <ul class="list-group">
                            <?php if (!empty($emprestimosAtivos)): ?>
                                <?php foreach ($emprestimosAtivos as $a): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><?php echo htmlspecialchars($a['tipo_nome'] . ' - ' . ($a['numeracao'] ?? '')); ?></div>
                                            <small class="text-muted">Usuário: <?php echo htmlspecialchars($a['usuario_nome']); ?> &nbsp;•&nbsp; Marca: <?php echo htmlspecialchars($a['marca']); ?> &nbsp;•&nbsp; Local: <?php echo htmlspecialchars($a['local_nome'] ?? 'Sem localização'); ?></small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill"><?php echo date('d/m H:i', strtotime($a['data_hora'])); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">Nenhum empréstimo ativo.</li>
                            <?php endif; ?>
                        </ul>
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
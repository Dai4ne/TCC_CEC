<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}


$perfil_verifica = '3';
include('../verifica.php');

/*
 * home_insp.php
 * - Propósito: dashboard do inspetor com resumo de notificações e empréstimos atrasados.
 * - Observações:
 *   - As consultas que obtêm os dados usam prepared statements e a include `includes/atrasos_query.php`
 *     para popular a variável `$atrasos` sem gerar saída HTML (apenas dados).
 */

// Para exibir o nome
$nomeUsuario = $_SESSION['nome_usuario'];
// Conexão com o banco
include __DIR__ . '/../Front-End_Admin/conect.php';

// Buscar notificações direcionadas ao inspetor
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

// Buscar empréstimos atrasados usando include de query (não inclui HTML nem session)
include __DIR__ . '/../includes/atrasos_query.php';
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
        body::-webkit-scrollbar {
            display: none;
            margin: 0;
            background: #f8f9fa;
        }

        main {
            padding: 2rem;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 0.5rem;
            margin-bottom: 2rem;
            color: #000000ff;
            text-align: center;
        }

        .table-section {
            background: #e5e7eb;
            border-radius: 8px;
            overflow-y: auto;
            padding: 1rem;
            margin-bottom: 2rem;
            height: 400px;
        }

        .table-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            min-height: 330px;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        td,
        th {
            text-align: center;
            padding: .6rem;
            border: 1px solid #e5e7eb;
        }

        .empty-state {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 1rem;
        }

        @media (max-width:768px) {
            h1 {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }
        }

        @media (max-width:576px) {
            h1 {
                font-size: 1.5rem;
                text-align: center;
            }

            td,
            th {
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

    <main>

        <div class="row">
            <div class="col-12">
                <h1 class="welcome-title">BEM-VINDO, <?= strtoupper(htmlspecialchars($nomeUsuario)); ?>!</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="table-section">
                    <div class="table-title">NOTIFICAÇÕES</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Remetente</th>
                                <th>Mensagem</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($notificacoes)): ?>
                                <?php foreach ($notificacoes as $n): ?>
                                    <tr data-notif-id="<?php echo intval($n['id_notificacao']); ?>">
                                        <td><?php echo htmlspecialchars($n['remetente_nome']); ?></td>
                                        <td style="text-align:left"><?php echo nl2br(htmlspecialchars($n['mensagem'])); ?></td>
                                        <td><button class="btn btn-sm btn-success mark-read-btn" data-id="<?php echo intval($n['id_notificacao']); ?>"><i class="bi bi-check-lg"></i></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="empty-state">Nenhuma notificação.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="table-section">
                    <div class="table-title">ATRASOS</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Professor</th>
                                <th>Aparelho</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($atrasos)): ?>
                                <?php foreach ($atrasos as $a): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($a['nome_professor']); ?></td>
                                        <td style="text-align:left"><?php echo htmlspecialchars($a['tipo_nome'] . ' - ' . ($a['numeracao'] ?? '')); ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($a['data_devolucao'])); ?></td>
                                        <td><?php echo ($a['status_emprestimo'] === 'T') ? 'ATRASADO' : htmlspecialchars($a['status_emprestimo']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="empty-state">Nenhum atraso no momento.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../script.js"></script>
<script>
$(document).on('click', '.mark-read-btn', function(e) {
    e.preventDefault();
    var id_notificacao = $(this).data('id-notificacao');
    
    $.post('../marcar_notificacao_ajax.php', {
        id_notificacao: id_notificacao
    }, function(response) {
        $('[data-notif-id="' + id_notificacao + '"]').remove();
    });
});
</script>
</html>
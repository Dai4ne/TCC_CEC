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
include "../equip_config.php";

// Processar ações de notificação / devolução
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['id_emprestimo'])) {
        $id_emprestimo = intval($_POST['id_emprestimo']);
        $action = $_POST['action'];
        
        if ($action === 'notificar') {
            // Buscar informações do empréstimo
            $stmt = $con->prepare("
                SELECT e.id_usuario, u.nome 
                FROM emprestimo e 
                JOIN usuario u ON e.id_usuario = u.id_usuario 
                WHERE e.id_emprestimo = ?
            ");
            $stmt->bind_param("i", $id_emprestimo);
            $stmt->execute();
            $result = $stmt->get_result();
            $emprestimo = $result->fetch_assoc();
            
            if ($emprestimo) {
                // Inserir notificação
                $mensagem = "Prezado professor, seu empréstimo está atrasado. Por favor, devolva o equipamento o mais breve possível.";
                $stmt = $con->prepare("
                    INSERT INTO notificacao (id_remetente, id_destinatario, mensagem, status_notificacao) 
                    VALUES (?, ?, ?, 'P')
                ");
                $stmt->bind_param("iis", $_SESSION['id_usuario'], $emprestimo['id_usuario'], $mensagem);
                
                if ($stmt->execute()) {
                    $_SESSION['msg_alert'] = ['success', 'Notificação enviada com sucesso!'];
                } else {
                    $_SESSION['msg_alert'] = ['error', 'Erro ao enviar notificação!'];
                }
            }
            
            header("Location: atrasos_insp.php");
            exit;
        }

        
    }
}

// Buscar empréstimos atrasados
$sql = "SELECT e.*, u.nome as nome_professor, eq.tipo, eq.numeracao, m.nome as marca,
        TIMESTAMPDIFF(HOUR, e.data_devolucao, CURRENT_TIMESTAMP) as horas_atraso
        FROM emprestimo e
        JOIN usuario u ON e.id_usuario = u.id_usuario
        JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
        JOIN marca m ON eq.id_marca = m.id_marca
        WHERE e.status_emprestimo IN ('A','T') 
            AND e.data_devolucao < CURRENT_TIMESTAMP
        ORDER BY e.data_devolucao ASC";

$resultado = $con->query($sql);
$atrasos = [];

if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        $row['tipo_nome'] = getTipoEquipamento($row['tipo']);
        $atrasos[] = $row;
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
            text-align: center;
        }


        .table tbody td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid var(--medium-gray);
        }


        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
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

    <h1 class="page-title p-4">ATRASOS</h1>

    <main class="main-content container-fluid">

        <div class="requests-table table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Aparelho</th>
                        <th>Data/Hora Prevista</th>
                        <th>Atraso</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($atrasos)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum atraso registrado</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($atrasos as $a): ?>
                            <tr>
                                <td><?= htmlspecialchars($a['nome_professor']) ?></td>
                                <td><?= htmlspecialchars($a['tipo_nome']) ?> <?= htmlspecialchars($a['marca']) ?> #<?= htmlspecialchars($a['numeracao']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($a['data_devolucao'])) ?></td>
                                <td>
                                    <span class="badge bg-danger">
                                        <?php
                                        $horas = (int)$a['horas_atraso'];
                                        if ($horas < 24) {
                                            echo $horas . 'h';
                                        } else {
                                            $dias = floor($horas / 24);
                                            $horas_restantes = $horas % 24;
                                            echo $dias . 'd ' . $horas_restantes . 'h';
                                        }
                                        ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="post" style="display:inline-block;">
                                        <input type="hidden" name="id_emprestimo" value="<?= $a['id_emprestimo'] ?>">
                                        <input type="hidden" name="action" value="notificar">
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-bell"></i> Notificar</button>
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
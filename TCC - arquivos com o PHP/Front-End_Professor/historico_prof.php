<?php
session_start();

// Impede cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Bloqueia acesso se não estiver logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$perfil_verifica = '2';
include('../verifica.php');

// Conexão com o banco e carregamento dos dados do usuário
include "../Front-End_Admin/conect.php";

$historico = [];
if (isset($_SESSION['id_usuario'])) {
  $idU = intval($_SESSION['id_usuario']);

  // Histórico de empréstimos do usuário (todos)
  $sqlHist = "SELECT e.*, eq.tipo, eq.numeracao, m.nome AS marca
        FROM emprestimo e
        JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
        LEFT JOIN marca m ON eq.id_marca = m.id_marca
        WHERE e.id_usuario = ?
        ORDER BY e.data_hora DESC";
  if ($stmt2 = $con->prepare($sqlHist)) {
    $stmt2->bind_param('i', $idU);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $tipos = [
      '1' => 'Televisão',
      '2' => 'Notebook',
      '3' => 'Chromebook',
      '4' => 'Tablet',
      '5' => 'Projetor',
      '6' => 'Fone'
    ];
    while ($row = $res2->fetch_assoc()) {
      $row['tipo_nome'] = $tipos[$row['tipo']] ?? ($row['tipo'] ?: 'Desconhecido');
      $historico[] = $row;
    }
    $stmt2->close();
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

                        <a href="home_prof.php">
                            <div class="nav-icon"> <i class="bi bi-house-door-fill"></i></div>
                        </a> <!--HOMEPAGE-->

                        <a href="equipamentos_prof.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a><!--EQUIPAMENTOS-->

                        <a href="notificacao_prof.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- NOTIFICAÇÕES -->

                        <a href="historico_prof.php">
                            <div class="nav-icon"><i class="bi bi-clock-history"></i></div>
                        </a> <!--HISTÓRICO-->

                        <a href="perfil_prof.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!--PERFIL-->

                        <a href="">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> 
                        </a> <!-- CONFIGURAÇÕES-->

                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content container-fluid">
        <h1 class="page-title">HISTÓRICO</h1>

        <div class="requests-table table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Aparelho</th>
                        <th>Marca</th>
                        <th>Data</th>
                        <th>Emprestado em</th>
                        <th>Devolvido em</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($historico)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum histórico de empréstimos</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($historico as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['tipo_nome']) ?> #<?= htmlspecialchars($item['numeracao']) ?></td>
                                <td><?= htmlspecialchars($item['marca'] ?? 'N/A') ?></td>
                                <td><?= date('d/m/Y', strtotime($item['data_hora'])) ?></td>
                                <td><?= date('H:i', strtotime($item['data_hora'])) ?></td>
                                <td>
                                    <?php 
                                    if ($item['status_emprestimo'] === 'D' && !empty($item['data_devolucao'])) {
                                        echo date('H:i', strtotime($item['data_devolucao']));
                                    } elseif ($item['status_emprestimo'] === 'P') {
                                        echo '<span class="badge bg-warning">Pendente</span>';
                                    } elseif ($item['status_emprestimo'] === 'A') {
                                        echo '<span class="badge bg-success">Em uso</span>';
                                    } elseif ($item['status_emprestimo'] === 'R') {
                                        echo '<span class="badge bg-danger">Rejeitado</span>';
                                    } else {
                                        echo '—';
                                    }
                                    ?>
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
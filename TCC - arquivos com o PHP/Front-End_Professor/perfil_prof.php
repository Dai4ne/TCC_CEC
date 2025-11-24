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

$usuarioDados = null;
$historico = [];
if (isset($_SESSION['id_usuario'])) {
  $idU = intval($_SESSION['id_usuario']);
  // Dados do usuário
  if ($stmt = $con->prepare("SELECT nome, email, tipo, data_registro FROM usuario WHERE id_usuario = ?")) {
    $stmt->bind_param('i', $idU);
    $stmt->execute();
    $res = $stmt->get_result();
    $usuarioDados = $res->fetch_assoc();
    $stmt->close();
  }

  // Histórico de empréstimos do usuário (últimos 10)
    $sqlHist = "SELECT e.*, eq.tipo, eq.numeracao, m.nome AS marca
        FROM emprestimo e
        JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
        LEFT JOIN marca m ON eq.id_marca = m.id_marca
        WHERE e.id_usuario = ?
        ORDER BY e.data_hora DESC
        LIMIT 4";
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
   <script>
        // Se o usuário usar "voltar" e a sessão não existir, redireciona
        window.onload = function() {
            if (!<?php echo isset($_SESSION['id_usuario']) ? 'true' : 'false'; ?>) {
                window.location.href = 'login.php';
            }
        }
        // Evita cache via back button
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        }
    </script>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

        main{
            box-shadow: 2px 2px 6px #0000001d;
            width: 580px;
        }

        .topo-cinza {
            background-color: #e5e7eb;
            height: 200px;
            width: 100%;
            margin-top: 10px
        }

        #perfil {
            margin-top: -60px;
        }

        .nome {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #000;
        }

        .dados {
            text-align: left;
            max-width: 400px;
            margin: 30px auto 0 auto;
        }

        .dados h2 {
            font-size: 12px;
            color: #000;
            margin-bottom: 20px;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 2px;
            color: #000;
        }

        .valor {
            border-bottom: 1px solid #e5e7eb;
            padding: 4px 0;
            font-size: 14px;
            color: #000;
            margin: 0;
        }

        .historico-container {
            padding: 30px 20px;
            background-color: white;
            box-shadow: 2px 2px 6px #0000001d;

        }

        .tabela {
            background-color: #e5e7eb;
            border: none;
        }

        .titulo-tabela {
            background-color: #e5e7eb;
            text-align: center;
            font-weight: bold;
            padding: 10px 0;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            font-size: 12px;
            color: #000;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            }

        tbody td {
            height: 40px;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            color: #000;
        }

        .botoes {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #072855;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 6px;
            color: white;
        }

        .btn:hover{
            background-color: #0e78a9;
            color: white;
        }

        a{
            text-decoration: none;
            color: white;
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

                        <a href="config_termos_prof.php">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> 
                        </a> <!-- CONFIGURAÇÕES-->

                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="container my-4">
        <div class="row g-4 justify-content-center">
            <main class="col-12 col-lg-7">
                <div class="topo-cinza"></div>

                <section class="conteudo text-center">
                    <img src="../Imagens/Ícones/foto-perfil.png" alt="" id="perfil" width="110px">
                    <p class="nome"><?= htmlspecialchars($usuarioDados['nome'] ?? $_SESSION['nome_usuario']) ?></p>

                    <div class="dados">
                        <h2>DADOS PESSOAIS</h2>

                        <div class="campo">
                        <label>NOME:</label>
                        <p class="valor"><?= htmlspecialchars($usuarioDados['nome'] ?? '') ?></p>
                        </div>

                        <div class="campo">
                        <label>EMAIL:</label>
                        <p class="valor"><?= htmlspecialchars($usuarioDados['email'] ?? '') ?></p>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="col-12 col-lg-4">
                <div class="historico-container">
                <div class="tabela">
                    <div class="titulo-tabela">HISTÓRICO</div>
                    <table>
                    <thead>
                        <tr>
                            <th>APARELHO</th>
                            <th>DATA</th>
                            <th>HORA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($historico)): ?>
                        <tr>
                            <td colspan="3" class="text-center">Nenhum histórico de empréstimos</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($historico as $h): ?>
                            <tr>
                            <td><?= htmlspecialchars($h['tipo_nome']) ?> <?= htmlspecialchars($h['marca'] ?? '') ?> #<?= htmlspecialchars($h['numeracao'] ?? '') ?></td>
                            <td><?= date('d/m/Y', strtotime($h['data_hora'])) ?></td>
                            <td><?= date('H:i', strtotime($h['data_hora'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    </table>
                </div>

                <div style="margin-top:12px;">
                    <a href="historico_prof.php" class="btn w-100">Ver todos</a>
                </div>

                <div class="botoes">
                    <button class="btn">
                        <i class="bi bi-gear-fill"></i> 
                        <a href="config_termos_prof.php">Configurações</a>
                    </button>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-box-arrow-right"></i> Desconectar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="text-center">
                                    <h4>Confirmar Saída</h4>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <a href="../logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i> Sair</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </aside>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
include 'verifica_login.php';
verificaTipo('1'); // Verifica se é admin

$nomeUsuario = $_SESSION['nome_usuario']; // pega o nome pra exibir
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

        body {
            margin: 0;
            background: #f8f9fa;
            font-family: Poppins, Arial;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 2rem;
            margin-bottom: 2rem;
            color: #1f2937;
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
            color: #374151;
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
                        <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div> <!-- HOMEPAGE-->
                        <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> <!-- CONFIGURAÇÕES-->
                        <div class="nav-icon"><i class="bi bi-bell-fill"></i></div> <!-- NOTIFICAÇÕES -->
                        <div class="nav-icon"><i class="bi bi-person-fill"></i></div> <!-- PERFIL-->
                        <div class="nav-icon"><i class="bi bi-plus-square-fill"></i></div> <!-- CADASTRAR -->
                        <div class="nav-icon"><i class="bi bi-exclamation-triangle-fill"></i></div> <!-- ATRASOS -->
                        <div class="nav-icon"><i class="bi bi-tv-fill"></i></div> <!-- EQUIPAMENTOS -->
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
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-chat-dots-fill me-2"></i>PENDÊNCIAS</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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

    <title>CEC</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Federo&family=Poppins&display=swap');

        body {
            margin: 0;
            background: #f8f9fa;
            font-family: Poppins, Arial;
        }

        header {
            background: linear-gradient(135deg, #072855 0%, #0e78a9 50%, #12bdeb 100%);
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-icons {
            display: flex;
            gap: 1rem;
        }

        .nav-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .nav-icon i {
            font-size: 1.4rem;
            color: #1e3a8a;
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
            header {
                padding: 0 1rem;
                height: 100px;
            }

            .logo-circle {
                width: 60px;
                height: 60px;
            }

            .nav-icon {
                width: 35px;
                height: 35px;
            }

            h1 {
                font-size: 1.6rem;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width:576px) {
            .nav-icon {
                width: 30px;
                height: 30px;
            }

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
    <header>
        <div class="logo-circle">
            <img src="../Imagens/logo_100.png" alt="logo" class="img-fluid">
        </div>
        <div class="nav-icons">
            <div class="nav-icon"><a href="home_admin.php"><i class="bi bi-house-door-fill"></i></a></div>
            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div>
            <div class="nav-icon"><a href="cadastros_admin.php"><i class="bi bi-plus-square-fill"></i></a></div>
            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
            <div class="nav-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
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
<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$perfil_verifica = '3';
include('../verifica.php');

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

        .equipment-icon i {
            font-size: 2rem;
            color: #000000ff;
        }

        a {
            text-decoration: none;
            color: black;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .equipment-item {
            font-weight: bold;
        }
        
        .equipment-item:hover {
            background-color: #e5e7eb;
        }

        .btn-light i {
            pointer-events: none;
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

<body class="bg-light">

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


    <main class="container py-4">

        <div class="input-group mb-4">
            <span class="input-group-text bg-secondary-subtle"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Pesquisar equipamentos">
        </div>

        <div class="row g-4 justify-content-center">

            <div class="col-lg-7 col-md-10">
                <div class="bg-body rounded shadow-sm">
                    
                    <h5 class="text-center fw-bold pt-3 pb-3 mb-0 border-bottom">EQUIPAMENTOS</h5>

                    <a href="equip_televisao_insp.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2 px-3">
                        <span>TELEVISÃO</span>
                        <div class="equipment-icon"><i class="bi bi-tv-fill"></i></div>
                    </div>
                    </a>

                    <a href="equip_notebook_insp.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2 px-3">
                            <span>NOTEBOOK</span>
                            <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                        </div>
                    </a>

                    <a href="equip_chromebook_insp.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2 px-3">
                            <span>CHROMEBOOK</span>
                            <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                        </div>
                    </a>

                    <a href="equip_tablet_insp.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2 px-3">
                            <span>TABLET</span>
                            <div class="equipment-icon"><i class="bi bi-tablet"></i></div>
                        </div>                        
                    </a>

                    <a href="equip_projetor_insp.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2 px-3">
                            <span>PROJETOR</span>
                            <div class="equipment-icon"><i class="bi bi-projector"></i></div>
                        </div>
                    </a>

                    <a href="equip_fone_insp.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center py-2 px-3">
                            <span>FONES</span>
                            <div class="equipment-icon"><i class="bi bi-headphones"></i></div>
                        </div>
                    </a>


                </div>
            </div>
            
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit;
    }

    $perfil_verifica = '1';
    include('../verifica.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="header_admin.css">
    <title>CEC</title>

    <style>
        /* Garente que o corpo ocupe toda a altura da tela */
        html, body {
            height: 100%; 
            margin: 0px;
            padding: 0;
            overflow-x: hidden;
        }

        body { 
            display: flex; 
            flex-direction: column;
        }

        /* SOLUÇÃO PARA OCULTAR A BARRA DE ROLAGEM E REMOVER O ESPAÇO RESERVADO */
        body::-webkit-scrollbar {
            width: 0px; 
            background: transparent;
        }

        
        .page-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            background-color: #e5e7eb;
            padding: 20px 0;
            margin-bottom: 0;
            flex-shrink: 0; 
        }

        main {
            flex-grow: 1;
            /* Faz com que o main ocupe todo o espaço vertical restante */
            display: flex;
            justify-content: center;
            /* Centraliza horizontalmente */
            align-items: center;
            /* Centraliza verticalmente */
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
            overflow: visible;
        }

        a {
            text-decoration: none;
            height: 100%;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* Duas colunas de igual largura por padrão */
            gap: 20px;
            max-width: 700px;
            width: 100%;
            grid-auto-rows: 1fr;
        }

        .dashboard-card {
            background: #e5e7eb;
            border-radius: 12px;
            padding: 20px 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            text-align: center;
            
            height: 100%; 
            min-height: auto; 

            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            line-height: 1.3;
            color: #000000ff;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.24);
        }


        @media (max-width:992px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
                /* duas colunas */
                gap: 30px;
                grid-auto-rows: 1fr; /* Manter a altura igual */
            }

            .dashboard-card {
                font-size: 1.3rem;
                padding: 15px 10px;
                min-height: auto;
            }
        }


        @media (max-width:768px) { /* Para tablets e telas menores */
            h1 {
                font-size: 1.7rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
                gap: 15px;
                grid-auto-rows: minmax(100px, auto); /* Altura mínima/adaptativa */
            }

            .dashboard-card {
                font-size: 1.2rem;
                padding: 20px 15px;
                /* Removido: min-height: 100px; */
                min-height: auto;
            }
        }

        @media (max-width:576px) {

            /* Para celulares */
            .dashboard-card {
                padding: 15px 10px;
                font-size: 1rem;
                min-height: 90px;
            }

            .dashboard-grid {
                gap: 25px;
            }
        }

        @media (max-width: 400px){ /*Celulares*/

            .dashboard-grid {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                /* Duas colunas de igual largura por padrão */
                gap: 10px;
                max-width: 300px;
                width: 100%;
                /* caixa ocupa a largura total disponível até max-width */
            }

            .dashboard-card {
                font-size: 1.2rem;
            }

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

                        <a href="perfil_admin.php">
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

    <h1 class="page-title p-4">CADASTROS</h1>

    <main>
        <div class="dashboard-grid">

            <a href="cadastro_usuario_admin.php">
                <div class="dashboard-card">
                    CADASTRAR USUÁRIO
                </div>
            </a>

            <a href="user_professores_admin.php">
                <div class="dashboard-card">
                    USUÁRIOS REGISTRADOS NO SISTEMA
                </div>
            </a>

            <a href="cadastro_equip_admin.php">
                <div class="dashboard-card">
                    CADASTRAR EQUIPAMENTO
                </div>
            </a>

            <a href="equip_televisao_admin.php">
                <div class="dashboard-card">
                    EQUIPAMENTOS REGISTRADOS NO SISTEMA
                </div>
            </a>
        </div>
    </main>

</body>

</html>
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

        .page-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1rem;
            background-color: #dededeff;
        } 

        /* Estilos da Área de Gerenciamento de Usuários */
        .user-management-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Botões do tipo de usuário */
        .user-role-tab {
            margin-right: 10px;
            padding: 8px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            border: none;
            background-color: #072855; /* Fundo mais claro para inativo */
        }

        .user-role-tab:hover {
            background-color: #0084c1;
            color: white;
        }

        /*Mostra que a página de inspetores é que está selecionada no momento*/
        #inspetor {
            background-color: #0084c1;
        }


        /* A barra de pesquisa usa estilos centralizados em header_admin.css */

        /*Paginação*/ 
        .pagination {
            margin-top: 1rem;
            justify-content: center;
        }

        .page-link {
            color: #072855;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .page-item.active .page-link {
            background-color: #072855;
            border-color: #072855;
        }

        .page-link:hover {
            color: #0084c1;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        /* Lista de usuários */
        .user-list {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            overflow: hidden;
        }

        .user-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
            background-color: #ffffff;
        }

        .user-row:last-child {
            border-bottom: none;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Permite que ocupe o espaço restante */
            margin-right: 20px;
        }

        .user-name {
            font-weight: 600;
            font-size: 1rem;
            color: #212529;
        }

        .user-email {
            font-size: 0.85rem;
            color: #4c5054ff;
        }

        /*Status */
        .user-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-right: 20px;
            min-width: 80px;
            text-align: center;
        }

        .active-status {
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb;
        }

        .inactive-status {
            background-color: #f8d7da;
            color: #721c24; 
            border: 1px solid #f5c6cb;
        }

        /*botão de opções (reticências) */
        .options-btn {
            background: none;
            border: none;
            color: #495057;
            font-size: 1.2rem;
            padding: 5px;
            cursor: pointer;
            line-height: 1;
        }

        .options-btn:hover {
            color: #000000;
        }

        /* Responsividade para telas menores */
        @media (max-width: 992px) {
            .filters-search-row {
                flex-direction: column;
            }

            .user-role-tab {
                width: 160px;
                padding: 15px;
                font-size: 1rem;
                margin-bottom: 5px;
            }

            #admin /*Botão do admin*/ {
                width: 167px;
            }

            .search-box {
                margin-top: 10px;
                max-width: 100%;
            }


            .user-info {
                width: 100%;
                margin-bottom: 10px;
            }

            .user-status {
                margin-right: auto; /* Alinha o status à esquerda em telas pequenas */
            }

            .options-btn {
                margin-left: 15px;
            }
        }

         @media (max-width: 558px) {
            .user-role-tab {
                width: 110px;
                padding: 15px;
                font-size: 15px;
                margin: auto;
                margin-bottom: 2px;
                margin-left: 20px
            }

            #admin {
                width: 145px;
                text-align: center;
                margin-right: 0px;
            }
         }
    </style>

</head>

<body data-user-type="3">
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

    <h1 class="page-title p-4">USUÁRIOS CADASTRADOS</h1>

    <main class="container-fluid user-management-container">
        <div class="row mb-4 filters-search-row" id="pai_dos_botoes">

            <div class="col-12 col-lg-8 d-flex flex-wrap justify-content-start mb-3 mb-lg-0" id="botoes">
                <a href="user_professores_admin.php">
                    <button class="btn user-role-tab" id="professor">PROFESSOR</button>
                </a>

                 <a href="user_inspetores_admin.php">
                    <button class="btn user-role-tab" id="inspetor">INSPETOR</button>
                 </a>

                 <a href="user_admins_admin.php">
                    <button class="btn user-role-tab" id="admin">ADMINISTRADOR</button>
                 </a>
        
                
            </div>

            <!-- Barra de pesquisa-->
            <div class="col-12 col-lg-4 d-flex justify-content-end align-items-center">
                <div class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Pesquisar por nome ou e-mail..." />
                    <button class="search-clear" type="button" aria-label="Limpar busca"><i class="bi bi-x-lg"></i></button>
                </div>
            </div>

        </div>

        <div class="user-list">
            <!-- Lista preenchida via AJAX -->
        </div>

        <!-- Paginação (preenchida por JS) -->
        <nav aria-label="Paginação de usuários" class="mt-3">
            <ul class="pagination"></ul>
        </nav>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../js/user-search.js"></script>
    <script src="../script.js"></script>
</body>
</html>
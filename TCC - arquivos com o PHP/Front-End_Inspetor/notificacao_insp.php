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
            background: #ffffffff;
            font-family: Poppins, Arial;
        }

        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            background-color: #e5e7eb;
        }

        /*Botões de solicitação e notificação*/
        .category-buttons {
            display: flex;
            margin-bottom: 15px;
            gap: 10px;
        }

        .category-button{
            background-color: #0e78a9;
            color: white;
            font-weight: bold;
            margin-top: -10px;
            border-radius: 5px;
            padding: 10px;        
        }

        .category-button:hover{
            background-color: #053968;
            color: white;
            font-weight: bold;
        }

        a{
            text-decoration: none;
        }

        .main-content {
            padding: 30px 10px; 
            min-height: calc(100vh - 70px);
            background-color: #ffffffff;
        }

        /* Notificação e histórico */
        .notification-box{
            background-color: white; 
            border: 1px solid #dee2e6; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); 
        }


        a{
            text-decoration: none;
        }

        .requests-table {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }


        .table thead th {
            background:  #e5e7eb;
            border: none;
            text-align: center;
        }


        .table tbody td {
            text-align: center;
            vertical-align: middle;
        }
      

        /*Botão de lido*/
        .btn{
            background-color: #27ae60;
            color: white;
        }

        .btn:hover{
            background-color: #1d8548ff;
            color: white;
        }

        @media (max-width: 576px) {

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

    <h1 class="page-title p-4">NOTIFICAÇÃO</h1>

    <main class="main-content container-fluid">

        <div class="category-buttons">
            <a href="notificacao_insp.php">
                <div class="category-button">NOTIFICAÇÃO</div>
            </a>

            <a href="solicitacao_insp.php">
                <div class="category-button">SOLICITAÇÃO</div>
            </a>
        </div> 
        <div class="requests-table table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Remetente</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>  </th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>Arthur</td>

                            <td>Notebook lenovo número 10 está com problema PARA CARREGAR</td>

                            <td>22/11/2025</td>

                            <td>11:00</td>
                                
                            <td class="action-buttons">
                                <button type="submit" class="btn btn-approve"><i class="bi bi-check-lg"></i></button>
                            </td>
                        </tr>
                        
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../script.js"></script>
</html>
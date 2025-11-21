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
            background: #ffffffff;
            font-family: Poppins, Arial;
        }

        .page-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            background-color: #e5e7eb;
        }

        .main-content {
            padding: 30px; 
            min-height: calc(100vh - 70px);
            background-color: #ffffffff;
        }

        /* Notificação e histórico */
        .notification-box, .history-box {
            background-color: white; 
            border: 1px solid #dee2e6; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); 
        }

        /* Estilo para a caixa que agrupa o botão e o histórico */
        .history-container {
            display: flex;
            flex-direction: column;
        }

        /* botão "Notificações"*/
        .notification-button-history {
            background-color: #0084c1;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-radius: 4px; 
            cursor: pointer;
            text-transform: uppercase;
            margin-bottom: 10px; 
            border: 1px solid #0084c1; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        a{
            text-decoration: none;
        }

        /* Títulos das caixas*/
        .box-header {
            background-color: #e5e7eb;
            padding: 15px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            color: #000000ff; 
        }

        /* Caixa de nova notificação */
        .notification-box {
            display: flex;
            flex-direction: column;
            min-height: 400px;
            border-radius: 4px;
        }

        .notification-content {
            padding: 15px;
            flex-grow: 1; 
            display: flex;
            flex-direction: column;
        }

        /* Botões de Categoria */
        .category-buttons {
            display: flex;
            margin-bottom: 15px;
            gap: 10px;
        }

        .category-button {
            flex: 1; 
            padding: 10px 0;
            text-align: center;
            color: white;
            background-color: #0084c1;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .category-button:hover{
            background-color: #053968;
            color: white;
        }

        /* Mensagem */
        .message-textarea {
            width: 100%;
            flex-grow: 1; 
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            resize: none; 
            font-size: 1rem;
            color: #495057;
        }

        /*Botão de enviar*/
        .btn{
            background-color: #0084c1;
            color: white;
        }

        .btn:hover{
            background-color: #053968;
            color: white;
        }

        /* Caixa de histórico de envios */
        .history-box {
            min-height: 400px; 
            border-radius: 4px;
            border: 1px solid #dee2e6; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); 
        }

        .history-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            font-size: 1rem;
            color: #495057;
        }

        .history-item:last-child {
            border-bottom: none; 
        }

        .history-details {
            display: flex;
            gap: 15px;
            font-weight: 500;
            flex-shrink: 0; /* Impede que a data/hora quebre muito */
        }

        @media (max-width: 576px) {
            .history-item {
                flex-direction: column; /* Empilha o título e os detalhes */
                align-items: flex-start;
                gap: 5px;
            }
            .history-details {
                font-size: 0.9rem;
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

                        <a href="nova_notificacao_admin.php">
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

    <h1 class="page-title p-4">ENVIAR NOTIFICAÇÃO</h1>

    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center g-4">
                
                <div class="col-12 col-md-5 col-lg-4">

                    <a href="notificacao_admin.php">
                        <div class="notification-button-history">NOTIFICAÇÕES</div> 
                    </a>

                    <div class="notification-box">
                        <div class="box-header">NOVA NOTIFICAÇÃO</div>

                        <div class="notification-content">
                            <div class="category-buttons">
                                <div class="category-button">PROFESSORES</div>
                                <div class="category-button" >INSPETORES</div>
                            </div>
                            
                            <textarea class="message-textarea" placeholder="Digite sua mensagem"></textarea>

                            <button type="submit" name="action" value="Enviar" class="btn mt-3">Enviar</button>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="history-container"> 
                        
                        
                        <div class="history-box">
                            <div class="box-header">HISTÓRICO DE ENVIOS</div>
                            <ul class="history-list">

                                <li class="history-item">
                                    <span class="history-title">Reunião de Pais</span>
                                    <div class="history-details">
                                        <span class="history-time">12:00</span>
                                        <span class="history-date">25/09/2025</span>
                                    </div>
                                </li>

                                <li class="history-item">
                                    <span class="history-title">Vai toma no cu arthur</span>
                                    <div class="history-details">
                                        <span class="history-time">13:20</span>
                                        <span class="history-date">28/09/2025</span>
                                    </div>
                                </li>

    
                                <li class="history-item">
                                    <span class="history-title">Reunião de concelho</span>
                                    <div class="history-details">
                                        <span class="history-time">15:10</span>
                                        <span class="history-date">05/08/2025</span>
                                    </div>
                                </li>

                                <li class="history-item">
                                    <span class="history-title">Não usar a tv número 5</span>
                                    <div class="history-details">
                                        <span class="history-time">15:30</span>
                                        <span class="history-date">14/08/2025</span>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>

                    </div>
                </div>

                
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../script.js"></script>
</html>
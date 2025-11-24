<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}
$perfil_verifica = '2';
include(__DIR__ . '/../verifica.php');
include __DIR__ . '/../Front-End_Admin/conect.php';
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
        @import url('https://fonts.googleapis.com/css2?family=Federo&family=Poppins&display=swap');

        html, body{
            height: 100%;
            margin: 0px;
            padding: 0;
            overflow-x: hidden;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2.5rem;
            background-color: #e5e7eb;
        }

        /*Botões de solicitação e notificação*/
        .category-buttons {
            display: flex;
            margin-top: 10px;
            margin-bottom: 15px;
            /* ALTERADO: Centraliza os itens dentro do flexbox */
            justify-content: center;
            /* ALTERADO: Remove o deslocamento lateral que impedia a centralização */
            padding-left: 0;
        }

        .category-button {
            background-color: #0e78a9;
            color: white;
            font-weight: bold;
            margin-top: -10px;
            /* Alterado para 5px para não ficar grudado na borda se a tela for pequena */
            margin-left: 5px; 
            margin-right: 5px; 
            border-radius: 5px;
            padding: 10px;
        }

        .category-button:hover {
            background-color: #053968;
            color: white;
            font-weight: bold;
        }

        a {
            text-decoration: none;
        }

        .dashboard-card {
            min-height: 80vh;
            overflow-y: auto;
            background: #e5e7eb;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        /*Faz com que o texto permaneça sempre dentro do dashboard-card */
        .dashboard-card p,
        .dashboard-card h4 {
            word-wrap: break-word;
            /*palavras muito longas são quebradas */
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.24);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000000ff;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dashboard-card h4 {
            margin-top: 25px;
            color: #0e78a9;
            font-weight: 700;
        }

        @media (max-width:768px) {
            h1 {
                font-size: 1.6rem;
                margin-bottom: 1.5rem;
            }

            .dashboard-card {
                padding: 20px;
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

    <h1 class="page-title p-4"><i class="bi bi-gear-fill"></i> CONFIGURAÇÕES </h1>


    <main class="main-content">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="category-buttons">
                        <a href="config_termos_prof.php">
                            <div class="category-button">TERMOS DE USO</div>
                        </a>

                        <a href="config_sobre_prof.php">
                            <div class="category-button">SOBRE</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-info-circle me-2"></i>SOBRE</h2>

                        <p>O CEC – Controle de Equipamentos do Candelária é um sistema web desenvolvido com o objetivo principal de modernizar e otimizar a gestão de todos os aparelhos eletrônicos de propriedade da Escola Candelária. Criado como um Projeto de Conclusão de Curso (TCC), o CEC visa resolver os desafios logísticos associados ao controle de empréstimos, garantindo maior organização, transparência e responsabilidade no uso dos recursos tecnológicos da instituição.</p>

                        <h4>Funcionalidades e Usuários</h4>
                        <p>O sistema é estruturado em torno de três perfis de usuários, cada um com responsabilidades específicas para garantir a eficiência do fluxo de trabalho:</p>
                        <ul>
                            <li>Professor (Usuário Solicitante): Permite a solicitação de empréstimos, a visualização de seu histórico pessoal de uso, a devolução ágil dos itens e a notificação imediata de avarias ou problemas nos equipamentos.</li>
                            <li>Inspetor (Usuário de Monitoramento): Atua como o fiscalizador do fluxo. É responsável por aprovar ou negar as solicitações de empréstimo, monitorar ativamente os prazos de devolução, identificar e notificar casos de atraso, e manter um panorama completo dos equipamentos atualmente emprestados.</li>
                            <li>RAdministrador (Usuário de Gestão): É o responsável pela manutenção e integridade do sistema. Suas funções incluem o cadastro e gerenciamento de novos usuários e equipamentos, a visualização de todos os registros do sistema e o envio de notificações importantes aos demais perfis.</li>
                        </ul>

                        <h4>Objetivo</h4>
                        <p>O CEC busca não apenas registrar entradas e saídas, mas também criar um ambiente de uso consciente e documentado dos ativos da escola. Ao digitalizar o processo de controle, o sistema reduz erros manuais, agiliza a liberação e devolução de equipamentos e fornece dados valiosos para a manutenção e reposição futura de materiais. Em resumo, o CEC é uma ferramenta essencial para a governança tecnológica interna da Escola Candelária.</p>

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
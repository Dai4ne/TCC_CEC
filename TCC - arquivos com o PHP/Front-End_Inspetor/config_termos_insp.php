<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}
$perfil_verifica = '3';
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
            /* Apenas um ajuste visual, a margem e background já estavam definidos */
        }

        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 3.1rem;
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

    <h1 class="page-title p-4"><i class="bi bi-gear-fill"></i> CONFIGURAÇÕES </h1>


    <main class="main-content">

        <div class="category-buttons">
            <a href="config_termos_insp.php">
                <div class="category-button">TERMOS DE USO</div>
            </a>

            <a href="config_sobre_insp.php">
                <div class="category-button">SOBRE</div>
            </a>
        </div>

        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-file-text me-2"></i>TERMOS DE USO</h2>

                        <h4>1. Introdução e Aceitação</h4>
                        <p>1.1. O presente documento ("Termos de Uso") estabelece as regras de utilização do sistema web CEC – Controle de Equipamentos do Candelária, desenvolvido como Projeto de Conclusão de Curso (TCC) e destinado exclusivamente ao gerenciamento e controle de empréstimos de equipamentos eletrônicos de propriedade da Escola Candelária. </p>
                        <p>1.2. Ao acessar ou utilizar o sistema CEC, o usuário (seja Professor, Inspetor ou Administrador) declara ter lido, compreendido e aceito integralmente estes Termos de Uso. A não aceitação destes Termos implica a impossibilidade de utilização do sistema.</p>

                        <h4>2. Definições de Usuários e Acesso</h4>
                        <p>O sistema CEC possui três (3) perfis de usuário, cada um com permissões e responsabilidades específicas:</p>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Perfil</th>
                                        <th>Responsabilidades</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Professor</strong></td>
                                        <td>Solicitar empréstimos, devolver equipamentos, visualizar histórico de empréstimos, relatar problemas nos aparelhos.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Inspetor</strong></td>
                                        <td>Monitorar atividades de empréstimo/devolução, aprovar/reprovar solicitações, verificar atrasos, visualizar empréstimos ativos, enviar notificações ao Administrador e Professor.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Administrador</strong></td>
                                        <td>Gerenciar o sistema, cadastrar novos usuários e equipamentos, visualizar todos os registros, enviar notificações, desativar usuários.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <p>2.1. O acesso ao sistema é restrito e concedido exclusivamente pela Escola Candelária, por meio do perfil Administrador, a membros autorizados de seu corpo docente e funcional.</p>

                        <p>2.2. O usuário é responsável pela guarda e sigilo de sua senha de acesso. O uso indevido ou não autorizado da conta deve ser comunicado imediatamente ao Administrador do sistema.</p>


                        <h4>3. Responsabilidades e Deveres dos Usuários</h4>
                        <p>3.1. Deveres do Professor (Usuário Solicitante)</p>
                        <ul>
                            <li>Zelo e Cuidado: Utilizar os equipamentos emprestados com o devido zelo e cuidado, conforme as instruções de uso, responsabilizando-se por qualquer dano causado por negligência ou mau uso.</li>
                            <li>Devolução: Realizar a devolução do equipamento dentro do prazo estabelecido no ato do empréstimo. Atrasos na devolução podem gerar notificações e restrições de uso.</li>
                            <li>Relato de Problemas: Utilizar a funcionalidade de "Relatar Problemas" imediatamente após a constatação de qualquer defeito, avaria ou mau funcionamento do equipamento.</li>
                            <li>Uso Exclusivo: Os equipamentos devem ser utilizados para fins estritamente educacionais e dentro das dependências ou sob a responsabilidade da Escola Candelária.</li>
                        </ul>

                        <p>3.2. Deveres do Inspetor (Usuário de Monitoramento)</p>
                        <ul>
                            <li>Análise de Solicitações: Avaliar e responder às solicitações de empréstimo de forma justa, observando a disponibilidade dos equipamentos e o histórico do solicitante.</li>
                            <li>Monitoramento de Prazos: Monitorar ativamente os prazos de devolução, tomando as medidas cabíveis (como notificação ao Professor ou Administrador) em caso de atraso.</li>
                            <li>Comunicação: Utilizar o sistema para manter a comunicação clara e eficiente com o Administrador e os Professores sobre o status dos empréstimos.</li>
                        </ul>

                        <p>3.3. Deveres do Administrador (Usuário de Gestão)</p>
                        <ul>
                            <li>Manutenção de Dados: Garantir que os dados de usuários e equipamentos cadastrados no sistema estejam sempre atualizados e corretos.</li>
                            <li>Concessão de Acesso: Conceder e revogar acessos (cadastro/desativação de usuários) de forma responsável e mediante autorização da direção escolar.</li>
                            <li>Notificações: Utilizar a funcionalidade de notificação de forma clara e objetiva para informar sobre regras, problemas ou atualizações do sistema.</li>
                        </ul>

                        <h4>4. Condutas Vedadas</h4>
                        <p>É estritamente proibido aos usuários do sistema CEC:</p>
                        <ul>
                            <li>Tentar acessar, violar ou modificar dados de outros usuários ou de equipamentos para os quais não possua permissão.</li>
                            <li>Utilizar o sistema para fins diversos do gerenciamento de equipamentos da Escola Candelária.</li>
                            <li>Compartilhar a senha de acesso com terceiros, incluindo colegas de trabalho.</li>
                            <li>Causar intencionalmente danos, seja no sistema web ou nos equipamentos físicos controlados por ele.</li>
                            <li>Cadastrar informações falsas sobre equipamentos ou usuários.</li>
                        </ul>


                        <h4>5. Propriedade Intelectual</h4>
                        <p>5.1. O sistema CEC, incluindo seu código-fonte, design, interface e toda a sua estrutura lógica, é de propriedade intelectual do(a) aluno(a) desenvolvedor(a) (seu nome), sendo protegido pelas leis de direitos autorais.</p>

                        <p>5.2. O uso do sistema é concedido à Escola Candelária sob licença de uso, para fins acadêmicos e operacionais internos, e não implica em transferência de qualquer direito de propriedade intelectual ao usuário ou à escola.</p>


                        <h4>6. Disposições Finais</h4>
                        <p>6.1. Penalidades: O descumprimento destes Termos de Uso, especialmente as condutas vedadas e o mau uso dos equipamentos, poderá sujeitar o usuário a penalidades administrativas e/ou legais, conforme as normas internas da Escola Candelária, incluindo a desativação permanente do acesso ao sistema pelo Administrador.</p>

                        <p>6.2. Modificações: Estes Termos de Uso poderão ser alterados a qualquer momento pelo Administrador do sistema, com aviso prévio aos usuários para garantir a conformidade com as políticas internas da escola ou com a evolução do projeto.</p>
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
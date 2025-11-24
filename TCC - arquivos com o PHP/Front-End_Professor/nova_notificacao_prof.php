<?php
session_start();

// Normaliza msg_alert para evitar aviso de variável indefinida
$msg_alert = isset($_SESSION['msg_alert']) ? $_SESSION['msg_alert'] : null;
unset($_SESSION['msg_alert']);

/*
 * nova_notificacao_prof.php
 * - Propósito: permitir que um professor reporte dano para inspetores, administradores ou ambos.
 */

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}

$perfil_verifica = '2'; // PROFESSOR
include('../verifica.php');

// Caminho da conexão
include __DIR__ . '/../Front-End_Admin/conect.php';

$msg_history = [];


/* ===========================================================
   📨 PROCESSAMENTO DO FORMULÁRIO (ENVIO NO MESMO ARQUIVO)
   =========================================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mensagem = trim($_POST['mensagem'] ?? '');
    $destino = $_POST['destino'] ?? '';

    if ($mensagem === '' || $destino === '') {
        $_SESSION['msg_alert'] = ['danger', 'Preencha todos os campos!'];
        header('Location: nova_notificacao_prof.php');
        exit;
    }

    $ids = [];

    /* ==== DESTINOS ==== */
    if ($destino === 'administradores' || $destino === 'ambos') {
        $stmt = $con->prepare("SELECT id_usuario FROM usuario WHERE tipo = 1");
        $stmt->execute();
        $res = $stmt->get_result();
        while ($r = $res->fetch_assoc()) $ids[] = $r['id_usuario'];
        $stmt->close();
    }

    if ($destino === 'inspetores' || $destino === 'ambos') {
        $stmt = $con->prepare("SELECT id_usuario FROM usuario WHERE tipo = 3");
        $stmt->execute();
        $res = $stmt->get_result();
        while ($r = $res->fetch_assoc()) $ids[] = $r['id_usuario'];
        $stmt->close();
    }

    if (empty($ids)) {
        $_SESSION['msg_alert'] = ['warning', 'Nenhum usuário encontrado para este destino.'];
        header('Location: nova_notificacao_prof.php');
        exit;
    }

    /* ==== INSERIR NOTIFICAÇÕES ==== */
    $ins = $con->prepare("
        INSERT INTO notificacao (id_remetente, id_destinatario, mensagem, status_notificacao)
        VALUES (?, ?, ?, 'P')
    ");

    foreach ($ids as $id_dest) {
        $ins->bind_param("iis", $_SESSION['id_usuario'], $id_dest, $mensagem);
        $ins->execute();
    }

    $ins->close();

    $_SESSION['msg_alert'] = ['success', 'Dano reportado com sucesso!'];
    header('Location: nova_notificacao_prof.php');
    exit;
}


/* ===========================================================
   📜 HISTÓRICO DE NOTIFICAÇÕES DO PROFESSOR
   =========================================================== */
$stmt = $con->prepare("
    SELECT n.*, u.nome AS destinatario_nome 
    FROM notificacao n 
    JOIN usuario u ON n.id_destinatario = u.id_usuario 
    WHERE n.id_remetente = ? 
    ORDER BY n.data_envio DESC
");

$stmt->bind_param('i', $_SESSION['id_usuario']);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $msg_history[] = $row;
}

$stmt->close();
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
            min-height: 350px;
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
            height: 160px;
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
            height: 450px; 
            border-radius: 4px;
            border: 1px solid #dee2e6; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            overflow-y: auto; /*barra de rolagem vertical*/ 
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

                        <a href="home_prof.php">
                            <div class="nav-icon"> <i class="bi bi-house-door-fill"></i></div>
                        </a> <!--HOMEPAGE-->

                        <a href="equipamentos_prof.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a><!--EQUIPAMENTOS-->

                        <a href="notificacao_prof.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- NOTIFICAÇÕES -->

                        <a href="nova_notificacao_prof.php">
                            <div class="nav-icon"><i class="bi bi-pencil-square"></i></div> 
                        </a> <!-- CRIAR NOTIFICAÇÃO-->

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

    <h1 class="page-title p-4">REPORTAR DANO</h1>

    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center g-4">
                
                <div class="col-12 col-md-5 col-lg-4">

                    <a href="notificacao_prof.php">
                        <div class="notification-button-history">NOTIFICAÇÕES</div> 
                    </a>

                    <?php if ($msg_alert): ?>
                    <div class="alert alert-<?php echo $msg_alert[0]; ?> alert-dismissible fade show" role="alert">
                        <?php echo $msg_alert[1]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <div class="notification-box">
                        <div class="box-header">REPORTAR DANO</div>

                        <div class="notification-content">
                            <form method="post" action="">
                                <div class="category-buttons">
                                    <select name="destino" class="form-select" required>
                                        <option value="">Selecione o destino</option>
                                        <option value="inspetores">Inspetores</option>
                                        <option value="administradores">Administradores</option>
                                        <option value="ambos">Ambos</option>
                                    </select>
                                </div>
                                
                                <textarea name="mensagem" class="message-textarea" placeholder="Descreva o dano do equipamento..." required></textarea>

                                <button type="submit" name="action" value="Enviar" class="btn mt-3">Enviar</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="history-container"> 
                        
                        
                        <div class="history-box">
                            <div class="box-header">HISTÓRICO DE REPORTES</div>
                            <ul class="history-list">
                                <?php foreach ($msg_history as $h): ?>
                                <li class="history-item">
                                    <div><?php echo htmlspecialchars($h['mensagem']); ?></div>
                                    <div class="history-details">
                                        <span><?php echo htmlspecialchars($h['destinatario_nome']); ?></span>
                                        <span><?php echo date('d/m/Y H:i', strtotime($h['data_envio'])); ?></span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php if (empty($msg_history)): ?>
                                <li class="history-item" style="justify-content: center; color: #ccc;">
                                    Nenhum reporte enviado
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                    </div>
                </div>

                
            </div>
        </di>v
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../script.js"></script>
</html>
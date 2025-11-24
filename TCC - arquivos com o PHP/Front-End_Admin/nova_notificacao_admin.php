<?php
session_start();
/*
 * nova_notificacao_admin.php
 * - Propósito: permitir que um administrador envie notificações para grupos de usuários
 *   (professores ou inspetores) e visualizar histórico de envios.
 * - Fluxo:
 *   1) Verifica autenticação e perfil do remetente (admin).
 *   2) Ao receber POST, determina o público-alvo e insere registros na tabela `notificacao`
 *      para cada destinatário usando prepared statements.
 *   3) Monta também o histórico de envios do remetente para exibição.
 * - Observações:
 *   - O envio múltiplo é feito buscando usuários por tipo e inserindo um registro por destinatário.
 *   - Em cargas maiores, prefira operações em lote ou jobs em background para escalabilidade.
 */
// verifica sessão e perfil
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}
$perfil_verifica = '1';
include('../verifica.php');
include 'conect.php';

// Processa envio de nova notificação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Enviar') {
    $mensagem = trim($_POST['mensagem'] ?? '');
    $destino = $_POST['destino'] ?? '';

    if (empty($mensagem) || empty($destino)) {
        $_SESSION['msg_alert'] = ['danger', 'Preencha a mensagem e selecione o destino.'];
        header('Location: nova_notificacao_admin.php');
        exit;
    }

    // determinar tipo de usuário alvo
    if ($destino === 'professores') {
        $tipo_alvo = 2;
    } elseif ($destino === 'inspetores') {
        $tipo_alvo = 3;
    } else {
        $tipo_alvo = null;
    }

    $remetente = intval($_SESSION['id_usuario']);

    if ($tipo_alvo !== null) {
        $stmt = $con->prepare("SELECT id_usuario FROM usuario WHERE tipo = ?");
        $stmt->bind_param('i', $tipo_alvo);
        $stmt->execute();
        $res = $stmt->get_result();
        $insert = $con->prepare("INSERT INTO notificacao (id_remetente, id_destinatario, mensagem, status_notificacao) VALUES (?, ?, ?, 'P')");
        while ($row = $res->fetch_assoc()) {
            $id_dest = intval($row['id_usuario']);
            $insert->bind_param('iis', $remetente, $id_dest, $mensagem);
            $insert->execute();
        }
        $insert->close();
        $stmt->close();
        $_SESSION['msg_alert'] = ['success', 'Notificações enviadas.'];
        header('Location: nova_notificacao_admin.php');
        exit;
    }
}

// Histórico de envios do usuário logado
$msg_history = [];
$stmt_h = $con->prepare("SELECT n.*, u.nome as destinatario_nome FROM notificacao n JOIN usuario u ON n.id_destinatario = u.id_usuario WHERE n.id_remetente = ? ORDER BY n.data_envio DESC");
$stmt_h->bind_param('i', $_SESSION['id_usuario']);
$stmt_h->execute();
$res_h = $stmt_h->get_result();
while ($r = $res_h->fetch_assoc()) {
    $msg_history[] = $r;
}
$stmt_h->close();

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

                        <a href="notificacao_admin.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- NOTIFICAÇÕES -->

                        <a href="nova_notificacao_admin.php">
                            <div class="nav-icon"><i class="bi bi-pencil-square"></i></div> 
                        </a> <!-- CRIAR NOTIFICAÇÃO-->

                        <a href="perfil_admin.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!-- PERFIL-->

                        <a href="config_termos_admin.php">
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
                            <form method="post">
                                <div class="category-buttons mb-2">
                                    <select name="destino" class="form-select">
                                        <option value="professores">Professores</option>
                                        <option value="inspetores">Inspetores</option>
                                    </select>
                                </div>

                                <textarea name="mensagem" class="message-textarea" placeholder="Digite sua mensagem"></textarea>

                                <button type="submit" name="action" value="Enviar" class="btn mt-3">Enviar</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="history-container"> 
                        
                        
                        <div class="history-box">
                            <div class="box-header">HISTÓRICO DE ENVIOS</div>
                            <ul class="history-list">
                                <?php if (!empty($msg_history)): ?>
                                    <?php foreach ($msg_history as $h): ?>
                                        <li class="history-item">
                                            <span class="history-title"><?php echo nl2br(htmlspecialchars($h['mensagem'])); ?></span>
                                            <div class="history-details">
                                                <span class="history-time"><?php echo date('H:i', strtotime($h['data_envio'])); ?></span>
                                                <span class="history-date"><?php echo date('d/m/Y', strtotime($h['data_envio'])); ?></span>
                                                <span class="history-target">&nbsp;-&nbsp;<?php echo htmlspecialchars($h['destinatario_nome']); ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="history-item">Nenhum envio encontrado.</li>
                                <?php endif; ?>
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
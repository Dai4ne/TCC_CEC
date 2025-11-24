<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}
$perfil_verifica = '2';
include('../verifica.php');
include __DIR__ . '/../Front-End_Admin/conect.php';

/*
 * notificacao_prof.php
 * - Propósito: listar notificações do usuário professor e permitir marcar como lidas.
 * - Fluxo: valida sessão/perfil, trata POST para marcar notificações como lidas e busca
 *   notificações do usuário logado para exibição.
 */

// Marcar notificação como lida
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'], $_POST['id_notificacao'])) {
    $acao = $_POST['acao'];
    $id_not = intval($_POST['id_notificacao']);
    if ($acao === 'marcar_lida') {
        $upd = $con->prepare("UPDATE notificacao SET status_notificacao = 'L' WHERE id_notificacao = ? AND id_destinatario = ?");
        $upd->bind_param('ii', $id_not, $_SESSION['id_usuario']);
        $upd->execute();
        $upd->close();
        $_SESSION['msg_alert'] = ['success', 'Notificação marcada como lida.'];
    }
    header('Location: notificacao_prof.php');
    exit;
}

// Buscar notificações do usuário logado
$idLogado = intval($_SESSION['id_usuario']);
$stmt = $con->prepare("SELECT n.*, u.nome as remetente_nome FROM notificacao n JOIN usuario u ON n.id_remetente = u.id_usuario WHERE n.id_destinatario = ? ORDER BY n.data_envio DESC");
$stmt->bind_param('i', $idLogado);
$stmt->execute();
$res = $stmt->get_result();
$notificacoes = [];
while ($row = $res->fetch_assoc()) {
    $notificacoes[] = $row;
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
            margin-bottom: 1.5rem;
            background-color: #e5e7eb;
        }

        .main-content {
            padding: 10px; 
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

    <h1 class="page-title p-4">NOTIFICAÇÃO</h1>

    <main class="main-content container-fluid">
        <div class="requests-table table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>REMETENTE</th>
                        <th>MENSAGEM</th>
                        <th>DATA</th>
                        <th>HORA</th>
                        <th>  </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notificacoes)): ?>
                        <?php foreach ($notificacoes as $n): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($n['remetente_nome']); ?></td>
                                <td style="text-align:left"><?php echo nl2br(htmlspecialchars($n['mensagem'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($n['data_envio'])); ?></td>
                                <td><?php echo date('H:i', strtotime($n['data_envio'])); ?></td>
                                <td class="action-buttons">
                                    <form method="post" class="mark-read-form" style="display:inline;">
                                        <input type="hidden" name="id_notificacao" value="<?php echo intval($n['id_notificacao']); ?>">
                                        <input type="hidden" name="acao" value="marcar_lida">
                                        <button type="submit" class="btn"><i class="bi bi-check-lg"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma notificação encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../script.js"></script>
</html>

<script>
$(function(){
    $('.mark-read-form').on('submit', function(e){
        e.preventDefault();
        var $form = $(this);
        var id = $form.find('input[name="id_notificacao"]').val();
        $.post('../marcar_notificacao_ajax.php', {id_notificacao: id}, function(resp){
            if(resp && resp.success){
                $form.closest('tr').fadeOut(200, function(){ $(this).remove(); });
                $('[data-notif-id="'+id+'"]').fadeOut(200, function(){ $(this).remove(); });
            } else {
                alert(resp.error || 'Erro ao marcar notificação.');
            }
        }, 'json').fail(function(){ alert('Erro de rede ao marcar notificação.'); });
    });
});
</script>
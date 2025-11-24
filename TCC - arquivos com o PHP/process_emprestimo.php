<?php
session_start();

/*
 * process_emprestimo.php
 * - Propósito: endpoint que processa a solicitação de empréstimo de equipamento.
 * - Fluxo:
 *   1) Verifica sessão/autenticação e método POST.
 *   2) Recebe `id_equipamento` e `data_devolucao` do formulário.
 *   3) Verifica existência do equipamento e se já está emprestado/pendente.
 *   4) Insere um registro em `emprestimo` com status 'P' (pendente) e data/hora atual.
 * - Observações:
 *   - Usa prepared statements para evitar SQL injection.
 *   - Redireciona de volta para a página anterior, definindo mensagens de sessão em `$_SESSION['msg_alert']`.
 */

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

include "Front-End_Admin/conect.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Front-End_Professor/equipamentos_prof.php');
    exit;
}

// Receber dados
$id_equip = isset($_POST['id_equipamento']) ? intval($_POST['id_equipamento']) : 0;
$id_user = intval($_SESSION['id_usuario']);
$data_dev = isset($_POST['data_devolucao']) ? trim($_POST['data_devolucao']) : '';

// Se data_devolucao está vazia, não há obrigatoriedade
if (empty($data_dev)) {
    $data_dev = null;
} else {
    // Converter datetime-local para formato MySQL (datetime-local vem no formato: YYYY-MM-DDTHH:mm)
    $data_dev = str_replace('T', ' ', $data_dev) . ':00';
}

// Verificar se equipamento existe
$stmt = $con->prepare("SELECT id_equipamento FROM equipamento WHERE id_equipamento = ?");
$stmt->bind_param('i', $id_equip);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    $_SESSION['msg_alert'] = ['error', 'Equipamento não encontrado.'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'Front-End_Professor/equipamentos_prof.php'));
    exit;
}
$stmt->close();

// Verificar se equipamento já está emprestado
$stmt = $con->prepare("SELECT id_emprestimo FROM emprestimo WHERE id_equipamento = ? AND status_emprestimo IN ('P', 'A')");
$stmt->bind_param('i', $id_equip);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows > 0) {
    $_SESSION['msg_alert'] = ['error', 'Este equipamento já está emprestado ou com solicitação pendente.'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'Front-End_Professor/equipamentos_prof.php'));
    exit;
}
$stmt->close();

// Inserir empréstimo
$sql = "INSERT INTO emprestimo (id_usuario, id_equipamento, status_emprestimo, data_hora, data_devolucao) VALUES (?, ?, 'P', NOW(), ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('iis', $id_user, $id_equip, $data_dev);

if ($stmt->execute()) {
    $_SESSION['msg_alert'] = ['success', 'Solicitação de empréstimo enviada com sucesso!'];
} else {
    $_SESSION['msg_alert'] = ['error', 'Erro ao registrar solicitação: ' . $stmt->error];
}
$stmt->close();

header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'Front-End_Professor/equipamentos_prof.php'));
exit;


?>

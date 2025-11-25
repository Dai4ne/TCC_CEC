<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'error' => 'Sessão inválida']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método inválido']);
    exit;
}
$id = isset($_POST['id_notificacao']) ? intval($_POST['id_notificacao']) : 0;
if ($id <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}
include __DIR__ . '/Front-End_Admin/conect.php';

// Verifica se a notificação pertence ao usuário logado
$stmt = $con->prepare('SELECT id_destinatario FROM notificacao WHERE id_notificacao = ? LIMIT 1');
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();
if (!$row) {
    echo json_encode(['success' => false, 'error' => 'Notificação não encontrada']);
    exit;
}
if (intval($row['id_destinatario']) !== intval($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'error' => 'Permissão negada']);
    exit;
}

$del = $con->prepare("DELETE FROM notificacao WHERE id_notificacao = ? AND id_destinatario = ?");
$del->bind_param('ii', $id, $_SESSION['id_usuario']);
$ok = $del->execute();
$del->close();
if ($ok) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Falha ao deletar notificação']);
}

?>

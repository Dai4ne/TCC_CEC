<?php
session_start();

// Validação básica: só admin pode excluir
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}

$perfil_verifica = '1';
include(__DIR__ . '/../verifica.php');
include __DIR__ . '/conect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_usuario'])) {
    $_SESSION['msg_alert'] = ['danger', 'Requisição inválida.'];
    $redir = $_SERVER['HTTP_REFERER'] ?? 'user_professores_admin.php';
    header('Location: ' . $redir);
    exit;
}

$id_user = intval($_POST['id_usuario']);

// Não permitir excluir a si mesmo
if ($id_user === intval($_SESSION['id_usuario'])) {
    $_SESSION['msg_alert'] = ['danger', 'Você não pode excluir seu próprio usuário.'];
    $redir = $_SERVER['HTTP_REFERER'] ?? 'user_professores_admin.php';
    header('Location: ' . $redir);
    exit;
}

// Verificar se o usuário existe
$stmt = $con->prepare('SELECT id_usuario, nome, tipo FROM usuario WHERE id_usuario = ? LIMIT 1');
$stmt->bind_param('i', $id_user);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$stmt->close();

if (!$user) {
    $_SESSION['msg_alert'] = ['danger', 'Usuário não encontrado.'];
    $redir = $_SERVER['HTTP_REFERER'] ?? 'user_professores_admin.php';
    header('Location: ' . $redir);
    exit;
}

// Checar dependências: emprestimos ativos/pedidos, notificações, ocorrencias
$hasDeps = false;
$depMessages = [];

// emprestimo
$stmt = $con->prepare('SELECT COUNT(*) AS cnt FROM emprestimo WHERE id_usuario = ?');
$stmt->bind_param('i', $id_user);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();
if (intval($row['cnt']) > 0) {
    $hasDeps = true;
    $depMessages[] = 'Existem empréstimos registrados para esse usuário.';
}

// notificacoes como remetente ou destinatario
$stmt = $con->prepare('SELECT COUNT(*) AS cnt FROM notificacao WHERE id_remetente = ? OR id_destinatario = ?');
$stmt->bind_param('ii', $id_user, $id_user);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();
if (intval($row['cnt']) > 0) {
    $hasDeps = true;
    $depMessages[] = 'Existem notificações associadas a esse usuário.';
}

// ocorrencias
$stmt = $con->prepare('SELECT COUNT(*) AS cnt FROM ocorrencias WHERE id_usuario = ?');
$stmt->bind_param('i', $id_user);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();
if (intval($row['cnt']) > 0) {
    $hasDeps = true;
    $depMessages[] = 'Existem ocorrências registradas por esse usuário.';
}

if ($hasDeps) {
    $_SESSION['msg_alert'] = ['danger', 'Não é possível excluir o usuário: ' . implode(' ', $depMessages)];
    $redir = $_SERVER['HTTP_REFERER'] ?? 'user_professores_admin.php';
    header('Location: ' . $redir);
    exit;
}

// OK: excluir usuário
$stmt = $con->prepare('DELETE FROM usuario WHERE id_usuario = ? LIMIT 1');
$stmt->bind_param('i', $id_user);
if ($stmt->execute()) {
    $_SESSION['msg_alert'] = ['success', 'Usuário excluído com sucesso.'];
} else {
    $_SESSION['msg_alert'] = ['danger', 'Erro ao excluir: ' . $stmt->error];
}
$stmt->close();

$redir = $_SERVER['HTTP_REFERER'] ?? 'user_professores_admin.php';
header('Location: ' . $redir);
exit;
?>
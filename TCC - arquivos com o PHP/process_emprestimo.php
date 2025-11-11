<?php
session_start();

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
$qtd_aulas = isset($_POST['qtd_aulas']) ? intval($_POST['qtd_aulas']) : 1;
$data_dev = isset($_POST['data_devolucao']) ? trim($_POST['data_devolucao']) : '';

// Se data_devolucao está vazia, calcular baseado em aulas (1 aula = 50 minutos)
if (empty($data_dev)) {
    $agora = time();
    $minutos = $qtd_aulas * 50;
    $timestamp = $agora + ($minutos * 60);
    $data_dev = date('Y-m-d H:i:s', $timestamp);
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
if ($qtd_aulas !== null && $qtd_aulas > 0) {
    $sql = "INSERT INTO emprestimo (id_usuario, id_equipamento, status_emprestimo, data_hora, data_devolucao, qtd_aulas) VALUES (?, ?, 'P', NOW(), ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iisi', $id_user, $id_equip, $data_dev, $qtd_aulas);
} else {
    $sql = "INSERT INTO emprestimo (id_usuario, id_equipamento, status_emprestimo, data_hora, data_devolucao) VALUES (?, ?, 'P', NOW(), ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iis', $id_user, $id_equip, $data_dev);
}

if ($stmt->execute()) {
    $_SESSION['msg_alert'] = ['success', 'Solicitação de empréstimo enviada com sucesso!'];
} else {
    $_SESSION['msg_alert'] = ['error', 'Erro ao registrar solicitação: ' . $stmt->error];
}
$stmt->close();

header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'Front-End_Professor/equipamentos_prof.php'));
exit;


?>

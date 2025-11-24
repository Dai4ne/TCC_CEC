<?php
// logout.php
// - Propósito: encerrar a sessão do usuário e redirecionar para a página inicial.
// - Uso: incluir um link/button que aponte para este arquivo quando o usuário desejar sair.
session_start();
// Remove todos os dados da sessão e fecha a sessão atual
session_destroy();
// Após destruir a sessão, redireciona para a página pública de entrada
header("Location: index.php"); // redireciona para a página inicial
exit;
?>

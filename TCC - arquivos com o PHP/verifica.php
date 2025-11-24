<?php 
/*
 * verifica.php
 * - Propósito: arquivo auxiliar para validar se o usuário tem o perfil correto
 *   antes de acessar uma página protegida.
 * - Uso esperado: a página que inclui este arquivo deve:
 *     1) ter iniciado a sessão (`session_start()`) antes da inclusão;
 *     2) definir a variável `$perfil_verifica` com o número do perfil esperado
 *        (ex: 1 para admin, 2 para professor, 3 para inspetor);
 *   Exemplo:
 *     $perfil_verifica = 1;
 *     include 'verifica.php';
 * - Comportamento: redireciona para `index.php` se o perfil da sessão
 *   não for o esperado.
 */

if (!isset($_SESSION)) {
    // Nota: a sessão deve ser iniciada antes; se não, iniciamos para evitar warnings.
    session_start();
}

if (!isset($perfil_verifica) || $_SESSION['perfil'] !== $perfil_verifica) {
    header("Location: ../index.php");
    exit;
}

?>
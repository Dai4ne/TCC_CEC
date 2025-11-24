<?php
/*
 * Arquivo de conexão com o banco de dados
 * - Propósito: centralizar os parâmetros e a criação da conexão MySQLi usada por outras páginas.
 * - Variáveis:
 *   - $host: endereço do servidor de banco (ex: 'localhost').
 *   - $user: usuário do banco (ex: 'root').
 *   - $pass: senha do usuário do banco (vazia em ambiente local XAMPP).
 *   - $db:   nome do banco de dados (aqui 'bd_cec').
 * - Uso: incluir este arquivo nas páginas que precisam executar queries, por exemplo:
 *     include __DIR__ . '/conect.php';
 *   Após incluir, usar a variável `$con` (instância de `mysqli`) para `mysqli_query`, `prepare`, etc.
 * - Observações de segurança/produção:
 *   - Em produção, não mantenha credenciais em texto plano neste arquivo; prefira variáveis de ambiente
 *     ou um arquivo de configuração fora da raiz pública.
 *   - Considere usar `mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT)` durante
 *     desenvolvimento para facilitar o diagnóstico de erros.
 */

$host = "localhost";
$user = "root";
$pass = "";
$db   = "bd_cec";

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}

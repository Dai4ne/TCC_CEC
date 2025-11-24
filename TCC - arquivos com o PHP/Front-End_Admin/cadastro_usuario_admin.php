<?php
/*
 * cadastro_usuario_admin.php
 * - Propósito: formulário e processamento para cadastro de novos usuários pelo administrador.
 * - Fluxo:
 *   1) Recebe POST com nome, email, senha e tipo; valida campos e força da senha.
 *   2) Verifica se o e-mail já está cadastrado para evitar duplicidade.
 *   3) Gera hash seguro da senha via `createPasswordHash` (em `functions.php`) e insere o usuário
 *      usando prepared statement.
 * - Observações de segurança:
 *   - As senhas são armazenadas como hash; não armazene senhas em texto plano.
 *   - Em produção, valide também políticas de complexidade e limite tentativas de cadastro.
 */

include "conect.php";
include "../functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == "Cadastrar") {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $tipo  = trim($_POST['tipo']);
    
    if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
    echo "<script>alert('Preencha todos os campos!');</script>";
    exit;
    }

    // Validação de força da senha
    if (!isPasswordStrong($senha)) {
    echo "<script>alert('A senha deve ter pelo menos 8 caracteres, incluindo maiúsculas, minúsculas, números e caracteres especiais!');</script>";
    exit;
  }

    // Validação de e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('E-mail inválido!');</script>";
    exit;
    }

    // Verifica se o e-mail já está cadastrado
    $stmt = $con->prepare("SELECT id_usuario FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) {
    echo "<script>alert('Este e-mail já está cadastrado!');</script>";
    exit;
    }

    // Gera o hash da senha
    $senhaHash = createPasswordHash($senha);

    // Prepara a query com prepared statement
    $stmt = $con->prepare("INSERT INTO usuario (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $senhaHash, $tipo);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['msg_alert'] = ['success', 'Cadastrado com sucesso!'];
        header("Location: cadastro_usuario_admin.php");
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar usuário!');</script>";
    }

}
?>

<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
  header("Location: login.php");
  exit;
}

$perfil_verifica = '1';
include('../verifica.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" href="header_admin.css">
    <title>CEC</title>

  <style>
        html, body{
            height: 100%;
            margin: 0px;
            padding: 0;
            overflow-x: hidden;   
        }

        body::-webkit-scrollbar {
            display: none;
            margin: 0;
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            background-color: #e5e7eb;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
        }

        .form-card {
            padding: 2rem;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #1e3a8a;
            border: none;
            width: 200px;
        }

        .btn-primary:hover {
            background-color: #0e78a9;
        }

        @media (max-width: 400px) { /*Celulares*/
            .page-title {
                text-align: center;
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 2rem;
                background-color: #d0d0d0;
            }
        }
    </style>
</head>

<body>
    <?php 
    include '../alert/alert.php'
    ?>
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

    <h1 class="page-title p-4">CADASTRO DE USUÁRIO</h1>

    <div class="form-container">
        <div class="form-card">

            <form action="cadastro_usuario_admin.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do usuário" required />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@exemplo.com" required />
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required oninput="validatePassword(this.value)" />
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" onclick="togglePasswordVisibility('senha','toggleIcon')">
                        <i class="bi bi-eye-fill" id="toggleIcon"></i>
                        </button>
                    </div>

                    <!-- Indicadores de força da senha -->
                    <div class="mt-2">
                        <div class="progress" style="height: 5px;">
                            <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small id="password-strength-text" class="form-text"></small>
                    </div>

                    <!-- Requisitos da senha -->
                    <div class="mt-2 small">
                        <div id="password-length" class="text-danger"><i class="bi bi-x-circle-fill"></i> Mínimo de 8 caracteres</div>
                        <div id="password-uppercase" class="text-danger"><i class="bi bi-x-circle-fill"></i> Pelo menos uma letra maiúscula</div>
                        <div id="password-lowercase" class="text-danger"><i class="bi bi-x-circle-fill"></i> Pelo menos uma letra minúscula</div>
                        <div id="password-number" class="text-danger"><i class="bi bi-x-circle-fill"></i> Pelo menos um número</div>
                        <div id="password-special" class="text-danger"><i class="bi bi-x-circle-fill"></i> Pelo menos um caractere especial</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tipo" class="form-label">Tipo de usuário</label>
                    <select class="form-select" id="tipo" name="tipo" required>
                        <option disabled selected value="">Selecione uma opção</option>
                        <option value="1">Administrador</option>
                        <option value="2">Professor</option>
                        <option value="3">Inspetor</option>
                    </select>
                </div>

                <div class="d-grid justify-content-center">
                    <button type="submit" name="action" value="Cadastrar" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>

        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../js/password-validation.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="cadastro_usuario_admin.php"]');
    if (!form) return;
    form.addEventListener('submit', function(e) {
      const senha = document.getElementById('senha').value;
      if (!validatePassword(senha)) {
        e.preventDefault();
        alert('A senha não atende a todos os requisitos de segurança!');
      }
    });
  });
</script>

<script src="../script.js"></script>

</html>
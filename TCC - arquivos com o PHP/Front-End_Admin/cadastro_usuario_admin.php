<?php
include "conect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == "Cadastrar") {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $tipo  = trim($_POST['tipo']);

    if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
        echo "<script>alert('Preencha todos os campos!');</script>";
        exit;
    }

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario)
            VALUES ('$nome', '$email', SHA1('$senha'), '$tipo')";

    if ($con->query($sql)) {
        echo "<script>alert('Cadastrado com sucesso!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $con->error . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CEC - Cadastro Usuário</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

  <style>
    body {
      margin: 0;
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }

    header {
      background: linear-gradient(135deg, #072855 0%, #0e78a9 50%, #12bdeb 100%);
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
    }

    .logo-circle {
      width: 80px;
      height: 80px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .nav-icons {
      display: flex;
      gap: 1rem;
    }

    .nav-icon {
      width: 40px;
      height: 40px;
      background: white;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .nav-icon i {
      font-size: 1.4rem;
      color: #1e3a8a;
    }

    .page-title {
      text-align: center; 
      font-size: 1.8rem; 
      font-weight: bold; 
      margin-bottom: 2rem; 
      background-color: #d0d0d0;
    }

    .form-container {
      max-width: 600px;
      margin: auto;
    }

    .form-card {
      padding: 2rem;
      border-radius: 12px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-card h3 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #1e3a8a;
    }

    .btn-primary {
      background-color: #1e3a8a;
      box-shadow: 1px 1px  5px rgba(0, 0, 0, 0.51);
      border: none;
      width: 200px;
    }

    .btn-primary:hover {
      background-color: #0e78a9;
    }

  </style>
</head>

<body>
  <header>
    <div class="logo-circle">
      <img src="../Imagens/logo_100.png" alt="logo" class="img-fluid" />
    </div>
    <div class="nav-icons">
      <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div>

      <div class="nav-icon"><i class="bi bi-gear-fill"></i></div>

      <div class="nav-icon"><i class="bi bi-plus-square-fill"></i></div> <!-- Cadastro -->
      
      <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>

      <div class="nav-icon"><i class="bi bi-person-fill"></i></div>

      <div class="nav-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>

      <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
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
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required />
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
</html>

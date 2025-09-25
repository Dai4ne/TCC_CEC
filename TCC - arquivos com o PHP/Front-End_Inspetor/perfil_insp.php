<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CEC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f8f9fa;
    }

    header {
      background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
    }

    .logo-circle {
      width: 60px;
      height: 60px;
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

    .topo-cinza {
      background-color: #e4e4e4;
      height: 200px;
      width: 100%;
    }

    #perfil {
      margin-top: -60px;
    }

    .nome {
      font-size: 18px;
      font-weight: bold;
      margin-top: 10px;
      color: #000;
    }

    .dados {
      text-align: left;
      max-width: 400px;
      margin: 30px auto 0 auto;
    }

    .dados h2 {
      font-size: 12px;
      color: #000;
      margin-bottom: 20px;
    }

    .campo {
      margin-bottom: 20px;
    }

    .campo label {
      display: block;
      font-size: 12px;
      font-weight: bold;
      margin-bottom: 2px;
      color: #000;
    }

    .valor {
      border-bottom: 1px solid #ccc;
      padding: 4px 0;
      font-size: 14px;
      color: #000;
      margin: 0;
    }

    .historico-container {
      padding: 30px 20px;
      background-color: #fdfcf7;
    }

    .tabela {
      background-color: #fdfcf7;
      border: 1px solid #ccc;
    }

    .titulo-tabela {
      background-color: #eceae0;
      text-align: center;
      font-weight: bold;
      padding: 10px 0;
      color: #000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead th {
      font-size: 12px;
      color: #000;
      border-bottom: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }

    tbody td {
      height: 40px;
      border-bottom: 1px solid #ccc;
      padding: 10px;
      color: #000;
    }

    .botoes {
      margin-top: 30px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .btn {
      display: flex;
      align-items: center;
      gap: 10px;
      background-color: #eceae0;
      border: none;
      padding: 10px 15px;
      font-size: 14px;
      cursor: pointer;
      border-radius: 6px;
      color: #000;
    }

    @media (max-width: 768px) {
      .nav-icons {
        justify-content: center;
        margin-top: 10px;
      }

      .logo-container {
        width: 50px;
        height: 50px;
      }

      .nav-icon {
        width: 30px;
        height: 30px;
      }
    }
  </style>
</head>

<body>

  <header>
    <div class="logo-circle">
      <img src="../Imagens/logo_100.png" alt="logo" class="img-fluid">
    </div>
    <div class="nav-icons">
      <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div>
      <div class="nav-icon"><i class="bi bi-gear-fill"></i></div>
      <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
      <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
      <div class="nav-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
      <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
    </div>
  </header>

  <div class="container my-4">
    <div class="row g-4">
      <main class="col-12 col-lg-8">
        <div class="topo-cinza"></div>

        <section class="conteudo text-center">
          <img src="../Imagens/Ícones/foto-perfil.png" alt="" id="perfil" width="110px">
          <p class="nome">Nome</p>

          <div class="dados">
            <h2>DADOS PESSOAIS</h2>

            <div class="campo">
              <label>NOME:</label>
              <p class="valor">Nome completo</p>
            </div>

            <div class="campo">
              <label>EMAIL:</label>
              <p class="valor">email@exemplo.com</p>
            </div>
          </div>
        </section>
      </main>



      <aside class="col-12 col-lg-4">

        <div class="botoes">

          <button class="btn">
            <i class="bi bi-exclamation-circle-fill"></i> Avisos
          </button>

          <button class="btn">
            <i class="bi bi-clock-history"></i> Histórico geral
          </button>

          <button class="btn">
            <i class="bi bi-gear-fill"></i> Configurações
          </button>

          <button class="btn">
            <i class="bi bi-box-arrow-right"></i> Sair
          </button>
        </div>

    </div>

    </aside>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
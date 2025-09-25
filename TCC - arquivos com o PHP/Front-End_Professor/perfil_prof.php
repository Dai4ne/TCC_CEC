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

    .header {
      background: linear-gradient(135deg, #1e3a8a 0%, #0ea5e9 100%);
      padding: 15px 0;
      display: flex;
      align-items: center;
    }

    .logo-container {
      background: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo-container img {
      width: 40px;
      height: 40px;
    }

    .nav-icons {
      display: flex;
      gap: 25px;
      align-items: center;
    }

    .nav-icon {
      width: 35px;
      height: 35px;
      background: white;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: 0.3s;
    }

    .nav-icon i {
      font-size: 1.3rem;
      color: #1e3a8a;
    }

    .nav-icon:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

  <header class="header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-6 col-md-3">
          <div class="logo-container">
            <img src="../Imagens/logo_100.png" alt="logo">
          </div>
        </div>
        <div class="col-6 col-md-9">
          <div class="nav-icons justify-content-end">
            <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div>
            <div class="nav-icon"><i class="bi bi-clock-history"></i></div>
            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
          </div>
        </div>
      </div>
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
        <div class="historico-container">
          <div class="tabela">
            <div class="titulo-tabela">HISTÓRICO</div>
            <table>
              <thead>
                <tr>
                  <th>APARELHO</th>
                  <th>DATA</th>
                  <th>HORA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Notebook</td>
                  <td>01/08</td>
                  <td>10:00</td>
                </tr>
                <tr>
                  <td>Smartphone</td>
                  <td>02/08</td>
                  <td>12:30</td>
                </tr>
                <tr>
                  <td>Tablet</td>
                  <td>03/08</td>
                  <td>14:15</td>
                </tr>
                <tr>
                  <td>PC</td>
                  <td>04/08</td>
                  <td>09:00</td>
                </tr>
                <tr>
                  <td>Notebook</td>
                  <td>05/08</td>
                  <td>16:45</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="botoes">
            <button class="btn">
              <i class="bi bi-gear-fill"></i> Configurações
            </button>
            <button class="btn">
              <i class="bi bi-box-arrow-right"></i> Sair
            </button>
          </div>
        </div>
      </aside>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

```
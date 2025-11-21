<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="header_admin.css">
    <title>CEC</title>


    <style>
        body::-webkit-scrollbar {
            display: none;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }

        main{
            box-shadow: 2px 2px 6px #0000001d;
            width: 600px;
        }

        .topo-cinza {
            background-color: #e5e7eb;
            height: 200px;
            width: 100%;
            margin-top: 10px
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

        .botoes {
            margin-top: 8px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .btn {
            display: flex;
            align-items: center;
            height: 60px;
            width: 400px;
            gap: 10px;
            background-color: #e5e7eb;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            color: #000;
        }

        .btn:hover{
            background-color: #053968;
            color: white;
        }
    </style>
</head>

<body>

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

                        <a href="perfil_admin.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!-- PERFIL-->

                        <a href="">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div>
                        </a> <!-- CONFIGURAÇÕES-->

                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="row g-4 justify-content-center">
            <main class="col-12 col-lg-7">
                <div class="topo-cinza"></div>

                <section class="conteudo text-center">
                    <img src="../Imagens/Ícones/foto-perfil.png" alt="" id="perfil" width="110px">
                    <p class="nome"><?php echo htmlspecialchars($usuarioDados['nome'] ?? 'Nome'); ?></p>

                    <div class="dados">
                        <h2>DADOS PESSOAIS</h2>

                        <div class="campo">
                            <label>NOME:</label>
                            <p class="valor"><?php echo htmlspecialchars($usuarioDados['nome'] ?? 'Nome completo'); ?></p>
                        </div>

                        <div class="campo">
                            <label>EMAIL:</label>
                            <p class="valor"><?php echo htmlspecialchars($usuarioDados['email'] ?? 'email@exemplo.com'); ?></p>
                        </div>
                    </div>
                </section>
            </main>



        <aside class="col-12 col-lg-4 justify-content-center">
            <div class="botoes">

                <button class="btn ">
                    <i class="bi bi-bell-fill"></i>
                    <a href="notificacao_admin.php">Notificações</a>
                </button>

                <button class="btn">
                    <i class="bi bi-gear-fill"></i> Configurações
                </button>

                <!-- Button trigger modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-box-arrow-right"></i> Desconectar
                </button>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="text-center">
                                        <h4>Confirmar Saída</h4>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="../logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i> Sair</a>
                                    </div>

                                </div>
                            </div>
                        </div>    
            </div>
        </aside>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
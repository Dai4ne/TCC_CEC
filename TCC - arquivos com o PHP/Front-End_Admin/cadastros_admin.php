<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>CEC</title>

    <style>
        header {
            background: linear-gradient(135deg, #072855 0%, #0e78a9 50%, #12bdeb 100%);
            height: 120px;
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

        .main-content {
            padding: 40px 0;
        }

        .dashboard-card {
            width: 350px;
            background: #e5e7eb;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        @media (max-width:768px) {
            .header {
                padding: 10px 0;
            }

            .logo-container {
                width: 50px;
                height: 50px;
            }

            .nav-icons {
                gap: 15px;
            }

            .nav-icon {
                width: 30px;
                height: 30px;
            }

            .welcome-title {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }

            .dashboard-card {
                padding: 20px;
                margin-bottom: 15px;
            }
        }

        @media (max-width:576px) {
            .welcome-title {
                font-size: 1.5rem;
                text-align: center;
            }

            .dashboard-card {
                padding: 15px;
            }
        }


        @media (max-width:768px) {
            header {
                padding: 0 1rem;
                height: 100px;
            }

            .logo-circle {
                width: 60px;
                height: 60px;
            }

            .nav-icon {
                width: 35px;
                height: 35px;
            }

            h1 {
                font-size: 1.6rem;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width:576px) {
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
            <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div> <!-- Home -->

            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> <!-- Configurações -->

            <div class="nav-icon"><i class="bi bi-plus-square-fill"></i></div> <!-- Cadastro -->

            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div> <!-- Notificações -->

            <div class="nav-icon"><i class="bi bi-person-fill"></i></div> <!-- Perfil -->

            <div class="nav-icon"><i class="bi bi-exclamation-triangle-fill"></i></div> <!--  -->

            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div> <!-- Equipamentos  -->
        </div>
    </header>

    <h1 class="page-title p-4">CADASTROS</h1>

    <main class="main-content">
        <div class="container-fluid">
          
            <div class="row">

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-person-plus-fill me-2"></i>USUÁRIO</h2>
                    </div>
                </div

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-tv-fill me-2"></i>EQUIPAMENTO</h2>
                     </div>
                </div>
                
            </div>

            
            <div class="row justify-content-center">

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-tv-fill me-2"></i>USUÁRIOS REGISTRADOS</h2>
                    </div>
                </div>

                <div class="col-12 col-lg-4 ">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-tv-fill me-2"></i>EQUIPAMENTOS REGISTRADOS</h2>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
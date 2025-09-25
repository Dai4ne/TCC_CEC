<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .main-content {
            padding: 40px 0;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .dashboard-card {
            height: 300px;
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

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-content {
            padding-left: 20px;
            color: #374151;
            font-style: normal;
            list-style-type: disc;
        }

        @media (max-width:768px) {
            .header {
                padding: 10px 0;
            }

            .logo-container {
                width: 60px;
                height: 60px;
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

    <main class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="welcome-title">BEM-VINDO, PROFESSOR!</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-bell-fill me-2"></i>NOTIFICAÇÃO</h2>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-laptop-fill me-2"></i>EMPRESTADOS</h2>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <h2 class="card-title"><i class="bi bi-chat-dots-fill me-2"></i>RECADOS</h2>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
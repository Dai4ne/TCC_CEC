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
            background: #f8f9fa;
        }

        header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
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

        main {
            padding: 2rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #1f2937;
        }

        .table-section {
            background: #e5e7eb;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .table-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        td,
        th {
            text-align: center;
            padding: .6rem;
            border: 1px solid #e5e7eb;
        }

        .empty-state {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 1rem;
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

            h1 {
                font-size: 1.4rem;
            }

            th,
            td {
                padding: .4rem;
                font-size: .8rem;
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

    <main>
        <h1>BEM-VINDO, INSPETOR!</h1>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="table-section">
                    <div class="table-title">HISTÓRICO RECENTE</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Professor</th>
                                <th>Aparelho</th>
                                <th>Data</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="empty-state">...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="table-section">
                    <div class="table-title">ATRASOS</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Professor</th>
                                <th>Aparelho</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="empty-state">...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
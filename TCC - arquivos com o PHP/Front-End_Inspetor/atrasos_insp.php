<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3b82f6;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
        }


        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #0ea5e9 100%);
            padding: 15px 0;
            display: flex;
            align-items: center;
        }


        .logo-circle {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }


        .logo-circle img {
            width: 80%;
            height: 80%;
            object-fit: contain;
        }


        .nav-icons .btn {
            background: white;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            font-size: 18px;
            color: var(--primary-blue);
        }


        .nav-icons .btn:hover {
            background: var(--medium-gray);
        }


        .main-content {
            padding: 2rem 0;
        }

        .page-title {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }


        .requests-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }


        .table thead th {
            background: var(--medium-gray);
            text-align: center;
        }


        .table tbody td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid var(--medium-gray);
        }


        @media (max-width: 768px) {
            .logo-circle {
                width: 50px;
                height: 50px;
            }

            .logo-circle img {
                width: 80%;
                height: 80%;
            }

            .nav-icons .btn {
                width: 35px;
                height: 35px;
                font-size: 16px;
                margin-left: 5px;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="logo-circle">
                <img src="../Imagens/logo_100.png" alt="Logo">
            </div>

            <div class="nav-icons d-flex">
                <button class="btn"><i class="bi bi-house-door-fill"></i></button>
                <button class="btn"><i class="bi bi-bell-fill"></i></button>
                <button class="btn"><i class="bi bi-tv-fill"></i></button>
                <button class="btn"><i class="bi bi-person-fill"></i></button>
                <button class="btn"><i class="bi bi-exclamation-triangle-fill"></i></button>
            </div>
        </div>
    </header>

    <main class="main-content container-fluid">
        <h1 class="page-title">ATRASOS</h1>

        <div class="requests-table table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Aparelho</th>
                        <th>Data e Hora</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Ferrini</td>
                        <td>DataShow</td>
                        <td>15/08/2025 - 13:00</td>
                        <td>Devolvido</td>
                    </tr>

                    <tr>
                        <td>Enso</td>
                        <td>Notebook 24</td>
                        <td>15/08/2025 - 09:00</td>
                        <td>Não devolvido</td>
                    </tr>

                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>

                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>

                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>

                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
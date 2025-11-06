<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .equipment-icon i {
            font-size: 2rem;
            color: #1e3a8a;
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

        .equipment-item:hover {
            background-color: #e5e7eb;
        }

        .btn-light i {
            pointer-events: none;
        }

        @media (max-width: 768px) {
        .logo-circle { width: 50px; height: 50px; }
        .logo-circle img { width: 80%; height: 80%; }
        .nav-icons .btn { width: 35px; height: 35px; font-size: 16px; margin-left: 5px; }
        .page-title { font-size: 1.5rem; }
        .action-buttons { flex-direction: column; gap: 5px; }
        }
    </style>
</head>

<body class="bg-light">

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

    <main class="container py-4">

        <div class="input-group mb-4">
            <span class="input-group-text bg-secondary-subtle"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Pesquisar equipamentos">
        </div>

        <div class="row g-4">

            <div class="col-lg-6 col-md-12">
                <div class="bg-body rounded shadow-sm p-3">
                    <h5 class="text-center fw-bold mb-3">EQUIPAMENTOS</h5>

                    <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>TELEVISÃO</span>
                        <div class="equipment-icon"><i class="bi bi-tv-fill"></i></div>
                    </div>
                    <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>NOTEBOOK</span>
                        <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                    </div>
                    <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>CHROMEBOOK</span>
                        <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                    </div>
                    <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>TABLET</span>
                        <div class="equipment-icon"><i class="bi bi-tablet"></i></div>
                    </div>
                    <div class="equipment-item d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>PROJETOR</span>
                        <div class="equipment-icon"><i class="bi bi-projector"></i></div>
                    </div>
                    <div class="equipment-item d-flex justify-content-between align-items-center py-2">
                        <span>FONES</span>
                        <div class="equipment-icon"><i class="bi bi-headphones"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="bg-body rounded shadow-sm p-3">
                    <h5 class="text-center fw-bold mb-3">STATUS DE EMPRÉSTIMO</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Aparelho</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Chromebook</td>
                                    <td><span class="badge bg-success">Devolvido</span></td>
                                    <td>17/07/2025</td>
                                    <td>13:20</td>
                                </tr>
                                <tr>
                                    <td>Tablet</td>
                                    <td><span class="badge bg-warning text-dark">Em uso</span></td>
                                    <td>19/07/2025</td>
                                    <td>14:00</td>
                                </tr>
                                <tr>
                                    <td>Notebooks</td>
                                    <td><span class="badge bg-warning text-dark">Em uso</span></td>
                                    <td>25/07/2025</td>
                                    <td>08:30</td>
                                </tr>
                                <tr>
                                    <td>Televisão</td>
                                    <td><span class="badge bg-success">Devolvido</span></td>
                                    <td>25/07/2025</td>
                                    <td>11:00</td>
                                </tr>
                                <tr>
                                    <td>Projetor</td>
                                    <td><span class="badge bg-warning text-dark">Em uso</span></td>
                                    <td>05/08/2025</td>
                                    <td>15:00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

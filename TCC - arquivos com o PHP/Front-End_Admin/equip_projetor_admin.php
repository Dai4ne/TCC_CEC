<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}
$perfil_verifica = '1';
include(__DIR__ . '/../verifica.php');
include __DIR__ . '/conect.php';
include __DIR__ . '/../equip_config.php';
// Carregar projetores do banco com marca e local
$equipamento = [];
$sql = "SELECT e.*, m.nome AS marca_nome, l.nome AS local_nome
        FROM equipamento e
        JOIN marca m ON e.id_marca = m.id_marca
        LEFT JOIN `local` l ON e.id_local = l.id_local
        WHERE e.tipo = '5'
        ORDER BY (e.numeracao + 0) ASC";
$resultado = $con->query($sql);
if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $equipamento[] = $linha;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="header_admin.css">
    <title>CEC</title>
    

    <style>
        body::-webkit-scrollbar {
            display: none;
        }

        a {
            text-decoration: none;
            color: black;
        }

        /* CSS da parte dos equipamentos*/
        .equipment-icon i {
            font-size: 2rem;
            color: #0a39b9ff;
        }

        .equipment-item {
            padding: 10px 15px;
            transition: background-color 0.2s ;
            font-weight: bold;
        }

        .equipment-item:hover {
            background-color: #e5e7eb;
        }

        .equipment-item.active {
            background-color: #e5e7eb; /* Cor de fundo para o item selecionado */
            font-weight: bold;
        }
        
        .equipment-item .equipment-icon i {
            color: #000000ff;
        }

        /* Lista das TVs */
        .status-tag {
            padding: 2px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
            white-space: nowrap; 
        }

        .status-tag.active-tag {
            background-color: #10b981; /* ativo*/
        }

        .status-tag.inactive-tag {
            background-color: #ed586b; /* inativo */
        }

        .equipment-list-item {
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }


        .equipment-list-item:last-child {
            border-bottom: none;
        }

        .equipment-list-item .item-details {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .equipment-list-item .item-model {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: normal;
        }

        .more-options-icon {
            font-size: 1.5rem;
            color: #000000ff;
            cursor: pointer;
        }

        /* botões ativo e inativo */
        .filter-button {
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            margin-right: 10px;
        }

        .filter-button.active-filter {
            background-color: #10b981;
            color: white;
        }

        .filter-button.inactive-filter {
            background-color: #ed586b;
            color: white;
        }

        
        @media (max-width: 768px) {
            /* Adiciona margem entre as colunas "equipamentos" a listagem abaixo */
            .row.g-4 > .col-12:not(:last-child) {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body class="bg-light">

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


    <main class="container py-4">

        <div class="row g-4">

            <div class="col-12 col-lg-3">
                <div class="bg-white rounded shadow-sm">
                    
                    <h5 class="text-center fw-bold pt-3 pb-3 mb-0 border-bottom">EQUIPAMENTOS</h5>

                    <a href="equip_televisao_admin.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                        <span>TELEVISÃO</span>
                        <div class="equipment-icon"><i class="bi bi-tv-fill"></i></div>
                    </div>
                    </a>

                    <a href="equip_notebook_admin.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                            <span>NOTEBOOK</span>
                            <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                        </div>
                    </a>

                    <a href="equip_chromebook_admin.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                            <span>CHROMEBOOK</span>
                            <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                        </div>
                    </a>

                    <a href="equip_tablet_admin.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                            <span>TABLET</span>
                            <div class="equipment-icon"><i class="bi bi-tablet"></i></div>
                        </div>                  
                    </a>

                    <a href="equip_projetor_admin.php">
                        <div class="equipment-item active d-flex justify-content-between align-items-center border-bottom">
                            <span>PROJETOR</span>
                            <div class="equipment-icon"><i class="bi bi-projector"></i></div>
                        </div>
                    </a>

                </div>
            </div>


            <div class="col-12 col-lg-9">
                <div class="bg-white rounded shadow-sm p-3">
                    <div class="d-flex mb-3">
                        <span class="filter-button active-filter">ATIVO</span>
                        <span class="filter-button inactive-filter">INATIVO</span>
                    </div>

                    <div class="equipment-list">
                        <?php if (!empty($equipamento)): ?>
                            <?php foreach ($equipamento as $eq): ?>
                                <div class="equipment-list-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="item-details"><?php echo htmlspecialchars(strtoupper(getTipoEquipamento($eq['tipo'] ?? '')) . ' #' . ($eq['numeracao'] ?? '')); ?></span>
                                        <span class="item-model"><?php echo htmlspecialchars($eq['marca_nome'] ?? ''); ?></span>
                                        <small class="text-muted">Local: <?php echo htmlspecialchars($eq['local_nome'] ?? 'Sem localização'); ?></small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="status-tag <?= !empty($eq['status']) && $eq['status'] !== 'A' ? 'inactive-tag' : 'active-tag' ?> me-4"><?php echo !empty($eq['status']) && $eq['status'] !== 'A' ? 'INATIVO' : 'ATIVO'; ?></span>
                                        <button class="btn btn-sm btn-outline-secondary more-options-icon" type="button" data-bs-toggle="modal" data-bs-target="#equipDetailsModal"
                                            data-descricao="<?= htmlspecialchars(addslashes($eq['descricao'] ?? '')) ?>"
                                            data-numero-serie="<?= htmlspecialchars(addslashes($eq['numero_serie'] ?? '')) ?>"
                                            data-marca="<?= htmlspecialchars(addslashes($eq['marca_nome'] ?? '')) ?>"
                                            data-local="<?= htmlspecialchars(addslashes($eq['local_nome'] ?? 'Sem localização')) ?>"
                                            data-disponivel="<?= intval($eq['disponivel'] ?? 1) ?>"
                                            data-tipo-nome="<?= htmlspecialchars(getTipoEquipamento($eq['tipo'] ?? '')) ?>"
                                            data-numeracao="<?= htmlspecialchars($eq['numeracao'] ?? '') ?>">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-3 text-center">Nenhum equipamento cadastrado.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


        </div>

    </main>

    <?php include __DIR__ . '/../includes/equip_details_modal.php'; ?>


</body>

</html>
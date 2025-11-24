<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$perfil_verifica = '2';
include('../verifica.php');
/*
 * equip_chromebook_prof.php
 * - Propósito: listar equipamentos do tipo 'Chromebook' para professores.
 * - Fluxo: valida sessão/perfil e consulta `equipamento` com joins em `marca` e `local`.
 */

include "../Front-End_Admin/conect.php";
include "../equip_config.php";

$sql = "
    SELECT e.*, m.nome AS marca_nome, l.nome AS local_nome
    FROM equipamento e
    JOIN marca m ON e.id_marca = m.id_marca
    LEFT JOIN `local` l ON e.id_local = l.id_local
    WHERE e.tipo = '3'
";
$resultado = mysqli_query($con, $sql);

$equipamento = [];

while ($linha = mysqli_fetch_array($resultado)) {
    $equipamento[] = $linha;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="header_prof.css">
    <title>CEC</title>
    

    <style>
        .equipment-icon i {
            font-size: 2rem;
            color: #1e3a8a;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        a {
            text-decoration: none;
            color: black;
        }

        /* css da parte das TVs e equipamentos*/
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



        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            text-align: center;
            padding: 10px;
            background-color: white;
            transition: box-shadow 0.3s;
        }

        .product-card:hover {
            box-shadow: 0px 0px 15px  #0000007f;
        }
        
        .product-card-img {
            max-width: 100%;
            height: auto;
            background-color: #ffffffff;
            height: 150px; 
            margin-bottom: 10px;
            border-radius: 0.25rem;
        }
        
        img {
            width: 200px;
        }

        .btn{ /*Botão EMPRESTAR*/
            background-color: #0e78a9;
            color: white;
            font-weight: 600;
            border: none;
        }

        .btn:hover {
            background-color: #fd4463;
            color: white;
        }


        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            /* o menu e a listagem das TVs ficam em colunas de 12 */
            .col-lg-3, .col-lg-9 {
                width: 100%;
            }
            
            /* Adiciona margem entre as colunas "equipamentos" e as TVs */
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

                        <a href="home_prof.php">
                            <div class="nav-icon"> <i class="bi bi-house-door-fill"></i></div>
                        </a> <!--HOMEPAGE-->

                        <a href="equipamentos_prof.php">
                            <div class="nav-icon"><i class="bi bi-tv-fill"></i></div>
                        </a><!--EQUIPAMENTOS-->

                        <a href="notificacao_prof.php">
                            <div class="nav-icon"><i class="bi bi-bell-fill"></i></div>
                        </a> <!-- NOTIFICAÇÕES -->

                        <a href="nova_notificacao_prof.php">
                            <div class="nav-icon"><i class="bi bi-pencil-square"></i></div> 
                        </a> <!-- CRIAR NOTIFICAÇÃO-->

                        <a href="historico_prof.php">
                            <div class="nav-icon"><i class="bi bi-clock-history"></i></div>
                        </a> <!--HISTÓRICO-->

                        <a href="perfil_prof.php">
                            <div class="nav-icon"><i class="bi bi-person-fill"></i></div>
                        </a> <!--PERFIL-->

                        <a href="config_termos_prof.php">
                            <div class="nav-icon"><i class="bi bi-gear-fill"></i></div> 
                        </a> <!-- CONFIGURAÇÕES-->

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

            <div class="col-12 col-lg-3">
                <div class="bg-white rounded shadow-sm">
                    
                    <h5 class="text-center fw-bold pt-3 pb-2 mb-0 border-bottom">EQUIPAMENTOS</h5>

                    <a href="equip_televisao_prof.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                        <span>TELEVISÃO</span>
                        <div class="equipment-icon"><i class="bi bi-tv-fill"></i></div>
                    </div>
                    </a>

                    <a href="equip_notebook_prof.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                            <span>NOTEBOOK</span>
                            <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                        </div>
                    </a>

                    <a href="equip_chromebook_prof.php">
                        <div class="equipment-item active d-flex justify-content-between align-items-center border-bottom">
                            <span>CHROMEBOOK</span>
                            <div class="equipment-icon"><i class="bi bi-laptop"></i></div>
                        </div>
                    </a>

                    <a href="equip_tablet_prof.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                            <span>TABLET</span>
                            <div class="equipment-icon"><i class="bi bi-tablet"></i></div>
                        </div>                  
                    </a>

                    <a href="equip_projetor_prof.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center border-bottom">
                            <span>PROJETOR</span>
                            <div class="equipment-icon"><i class="bi bi-projector"></i></div>
                        </div>
                    </a>

                    <a href="equip_fone_prof.php">
                        <div class="equipment-item d-flex justify-content-between align-items-center">
                            <span>FONES</span>
                            <div class="equipment-icon"><i class="bi bi-headphones"></i></div>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Parte das TVs-->
            <div class="col-12 col-lg-9">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-3">
<?php foreach ($equipamento as $equipamentos): ?>
    <div class="col">
        <?php
        // Dados do equipamento
        $idEquip = intval($equipamentos['id_equipamento']);
        $tipo = $equipamentos['tipo'];
        $img = getImagemEquipamento($tipo);
        $marca = $equipamentos['marca_nome'];
        $num = $equipamentos['numeracao'];

        // Verificar se existe empréstimo pendente ou em uso para este equipamento
        $estado = 'emp'; // emp = disponível, solicitado, indisponivel
        if ($stmtChk = $con->prepare("SELECT id_emprestimo, id_usuario, status_emprestimo FROM emprestimo WHERE id_equipamento = ? AND status_emprestimo IN ('P','A') LIMIT 1")) {
            $stmtChk->bind_param('i', $idEquip);
            if ($stmtChk->execute()) {
                $resChk = $stmtChk->get_result();
                if ($resChk && $rowChk = $resChk->fetch_assoc()) {
                    if ($rowChk['status_emprestimo'] === 'A') {
                        $estado = 'indisponivel';
                    } elseif ($rowChk['status_emprestimo'] === 'P') {
                        if (intval($rowChk['id_usuario']) === intval($_SESSION['id_usuario'])) {
                            $estado = 'solicitado';
                        } else {
                            $estado = 'indisponivel';
                        }
                    }
                }
            }
            $stmtChk->close();
        }
        ?>

        <div class="product-card shadow-sm">
            <div class="product-card-img">
                <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars(getTipoEquipamento($tipo)) ?>">
            </div>
            <p class="card-text text-uppercase fw-bold mb-1"><?= htmlspecialchars($marca) ?></p>
            <p class="card-text text-uppercase small mb-1"><?= htmlspecialchars($num) ?></p>
            <p class="card-text small text-muted mb-3">Local: <?= htmlspecialchars($equipamentos['local_nome'] ?? 'Sem localização') ?></p>

            <?php if ($estado === 'emp'): ?>
                <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#modalEmprestimo" onclick="setEquipamentoModal(<?= $idEquip ?>, '<?= htmlspecialchars(getTipoEquipamento($tipo)) ?>')">EMPRESTAR</button>
            <?php elseif ($estado === 'solicitado'): ?>
                <button class="btn btn-warning w-100" disabled>SOLICITADO</button>
            <?php else: ?>
                <button class="btn btn-secondary w-100" disabled>INDISPONÍVEL</button>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

                          

                    
                </div>
            </div>

        </div>

    </main>

    <!-- Modal de Empréstimo -->
    <div class="modal fade" id="modalEmprestimo" tabindex="-1" aria-labelledby="modalEmprestimoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEmprestimoLabel">Emprestar Equipamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="../process_emprestimo.php" onsubmit="return validarEmprestimo()">
                    <div class="modal-body">
                        <div id="modalAlert"></div>
                        <p><strong>Equipamento:</strong> <span id="equipamentoNome"></span></p>
                        
                        <div class="mb-3">
                            <label for="horaDevolvida" class="form-label">Hora de Devolução <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="horaDevolvida" name="data_devolucao">
                            <small class="text-muted">Defina quando o equipamento deverá ser devolvido</small>
                        </div>

                        <input type="hidden" name="id_equipamento" id="idEquipamento" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar Empréstimo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setEquipamentoModal(idEquip, nomeEquip) {
            document.getElementById('idEquipamento').value = idEquip;
            document.getElementById('equipamentoNome').textContent = nomeEquip;
            const alertEl = document.getElementById('modalAlert');
            if (alertEl) alertEl.innerHTML = '';
            document.getElementById('horaDevolvida').value = '';
        }

        function validarEmprestimo() {
            const horaDevolvida = document.getElementById('horaDevolvida').value;
            const alertEl = document.getElementById('modalAlert');

            if (!horaDevolvida || horaDevolvida.trim() === '') {
                if (alertEl) {
                    alertEl.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Por favor, defina a hora de devolução do equipamento.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    alert('Por favor, defina a hora de devolução do equipamento.');
                }
                document.getElementById('horaDevolvida').focus();
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
<?php
include "conect.php";

function searchUsers($searchTerm = '', $tipo = null, $page = 1) {
    global $con;

    // Número de resultados por página
    $resultsPerPage = 10;
    $offset = ($page - 1) * $resultsPerPage;

    // Construir condições dinamicamente
    $where = [];
    $params = [];
    $types = "";

    if (!empty($searchTerm)) {
        $where[] = "(nome LIKE ? OR email LIKE ?)";
        $like = "%{$searchTerm}%";
        $params[] = $like;
        $params[] = $like;
        $types .= 'ss';
    }

    if ($tipo !== null && $tipo !== '') {
        // força inteiro
        $where[] = "tipo = ?";
        $params[] = (int)$tipo;
        $types .= 'i';
    }

    $whereSql = '';
    if (!empty($where)) {
        $whereSql = ' AND ' . implode(' AND ', $where);
    }

    // Query principal
    $query = "SELECT id_usuario, nome, email, tipo, data_registro FROM usuario WHERE 1=1" . $whereSql . " ORDER BY nome ASC LIMIT ? OFFSET ?";

    // preparar tipos/params para bind (adiciona limit/offset como inteiros)
    $execTypes = $types . 'ii';
    $execParams = array_merge($params, [$resultsPerPage, $offset]);

    $stmt = $con->prepare($query);
    if ($stmt === false) {
        return ['users' => [], 'total' => 0, 'pages' => 0, 'current_page' => $page];
    }

    if (!empty($execParams)) {
        // bind_param requires references
        $bind_names = [];
        $bind_names[] = $execTypes;
        for ($i = 0; $i < count($execParams); $i++) {
            $bind_name = 'bind' . $i;
            $$bind_name = $execParams[$i];
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Count total (sem limit/offset)
    $countQuery = "SELECT COUNT(*) as total FROM usuario WHERE 1=1" . $whereSql;
    $stmtCount = $con->prepare($countQuery);
    if ($stmtCount !== false && !empty($params)) {
        $bind_names = [];
        $bind_names[] = $types;
        for ($i = 0; $i < count($params); $i++) {
            $bind_name = 'cbind' . $i;
            $$bind_name = $params[$i];
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array([$stmtCount, 'bind_param'], $bind_names);
    }
    if ($stmtCount !== false) {
        $stmtCount->execute();
        $totalRows = $stmtCount->get_result()->fetch_assoc()['total'];
    } else {
        $totalRows = 0;
    }

    // Preparar o resultado
    $users = [];
    while ($row = $result->fetch_assoc()) {
        // Formatar a data com tolerância a valores nulos/zerados
        $formatted = '';
        if (!empty($row['data_registro']) && $row['data_registro'] !== '0000-00-00 00:00:00') {
            try {
                $date = new DateTime($row['data_registro']);
                $formatted = $date->format('d/m/Y H:i');
            } catch (Exception $e) {
                $formatted = '';
            }
        }
        $row['data_registro_formatada'] = $formatted;

        // Adicionar descrição do tipo
        switch((string)$row['tipo']) {
            case '1':
                $row['tipo_descricao'] = 'Administrador';
                break;
            case '2':
                $row['tipo_descricao'] = 'Professor';
                break;
            case '3':
                $row['tipo_descricao'] = 'Inspetor';
                break;
            default:
                $row['tipo_descricao'] = 'Desconhecido';
        }

        $users[] = $row;
    }

    return [
        'users' => $users,
        'total' => (int)$totalRows,
        'pages' => $resultsPerPage > 0 ? ceil($totalRows / $resultsPerPage) : 0,
        'current_page' => $page
    ];
}

// Se a requisição for AJAX
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    
    $searchTerm = $_GET['search'] ?? '';
    $tipo = $_GET['tipo'] ?? null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $result = searchUsers($searchTerm, $tipo, $page);
    echo json_encode($result);
    exit;
}
?>
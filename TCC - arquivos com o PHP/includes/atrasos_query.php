<?php
// Arquivo de inclusão que popula a variável $atrasos usando a conexão de BD existente ($con)
// NÃO inicia sessão nem gera saída HTML. Pode ser incluído em várias páginas sem efeitos colaterais.
if (!isset($con)) {
    // Tenta incluir o arquivo de conexão caso a variável $con não exista
    if (file_exists(__DIR__ . '/../Front-End_Admin/conect.php')) {
        include __DIR__ . '/../Front-End_Admin/conect.php';
    } else {
        return; // não é possível continuar sem a conexão
    }
}

// Garante que a função auxiliar para traduzir o tipo do equipamento esteja disponível
if (!function_exists('getTipoEquipamento')) {
    if (file_exists(__DIR__ . '/../equip_config.php')) {
        include __DIR__ . '/../equip_config.php';
    }
}

$atrasos = [];
// Consulta empréstimos com atraso (data_devolucao anterior ao momento atual e status ativo/atrasado)
$sql = "SELECT e.*, u.nome as nome_professor, eq.tipo, eq.numeracao, m.nome as marca, l.nome as local_nome,
        TIMESTAMPDIFF(HOUR, e.data_devolucao, CURRENT_TIMESTAMP) as horas_atraso
        FROM emprestimo e
        JOIN usuario u ON e.id_usuario = u.id_usuario
        JOIN equipamento eq ON e.id_equipamento = eq.id_equipamento
        JOIN marca m ON eq.id_marca = m.id_marca
        LEFT JOIN `local` l ON eq.id_local = l.id_local
        WHERE e.status_emprestimo IN ('A','T')
            AND e.data_devolucao < CURRENT_TIMESTAMP
        ORDER BY e.data_devolucao ASC";

$resultado = $con->query($sql);

if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        // adiciona a chave 'tipo_nome' traduzida pelo helper, se disponível
        if (function_exists('getTipoEquipamento')) {
            $row['tipo_nome'] = getTipoEquipamento($row['tipo']);
        } else {
            // fallback local com nomes legíveis caso o helper não exista
            $tipos = [
                '1' => 'Televisão',
                '2' => 'Notebook',
                '3' => 'Chromebook',
                '4' => 'Tablet',
                '5' => 'Projetor',
                '6' => 'Fone'
            ];
            $row['tipo_nome'] = $tipos[$row['tipo']] ?? 'Desconhecido';
        }
        $atrasos[] = $row;
    }
}

<?php
/**
 * Arquivo de configuração e funções auxiliares para equipamentos
 * Centraliza a lógica de tipos, imagens e dados dos equipamentos
 */

// Mapeamento de tipos de equipamento
$TIPOS_EQUIPAMENTO = [
    '1' => 'Televisão',
    '2' => 'Notebook',
    '3' => 'Chromebook',
    '4' => 'Tablet',
    '5' => 'Projetor',
    '6' => 'Fone'
];

// Mapeamento de imagens por tipo (usando placeholders)
$IMAGENS_EQUIPAMENTO = [
    '1' => '../Imagens/tv_lg.png',           // Televisão
    '2' => '../Imagens/notebook.png',         // Notebook
    '3' => '../Imagens/chromebook.png',       // Chromebook
    '4' => '../Imagens/tablet.png',           // Tablet
    '5' => '../Imagens/projetor.png',         // Projetor
    '6' => '../Imagens/fone.png'              // Fone
];

/**
 * Função para obter o nome do tipo de equipamento
 * @param string $tipo ID do tipo (1-6)
 * @return string Nome do tipo ou 'Desconhecido'
 */
function getTipoEquipamento($tipo) {
    global $TIPOS_EQUIPAMENTO;
    return $TIPOS_EQUIPAMENTO[$tipo] ?? 'Desconhecido';
}

/**
 * Função para obter a imagem do equipamento
 * @param string $tipo ID do tipo (1-6)
 * @param string $fallback Imagem de fallback padrão
 * @return string Caminho da imagem
 */
function getImagemEquipamento($tipo, $fallback = null) {
    global $IMAGENS_EQUIPAMENTO;
    
    if (isset($IMAGENS_EQUIPAMENTO[$tipo])) {
        return $IMAGENS_EQUIPAMENTO[$tipo];
    }
    
    if ($fallback) {
        return $fallback;
    }
    
    // Placeholder padrão
    return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="200" height="150"%3E%3Crect fill="%23f0f0f0" width="200" height="150"/%3E%3Ctext x="50%25" y="50%25" text-anchor="middle" dy=".3em" fill="%23999" font-family="sans-serif" font-size="14"%3EEquipamento%3C/text%3E%3C/svg%3E';
}

/**
 * Função para obter ícone do tipo de equipamento
 * @param string $tipo ID do tipo (1-6)
 * @return string Classe do ícone Bootstrap
 */
function getIconeEquipamento($tipo) {
    $icones = [
        '1' => 'bi-tv-fill',
        '2' => 'bi-laptop',
        '3' => 'bi-laptop',
        '4' => 'bi-tablet',
        '5' => 'bi-projector',
        '6' => 'bi-headphones'
    ];
    return $icones[$tipo] ?? 'bi-box';
}

?>

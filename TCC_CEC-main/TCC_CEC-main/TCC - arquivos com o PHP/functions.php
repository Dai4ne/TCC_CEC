<?php
// Função para criar hash seguro da senha
function createPasswordHash($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Função para verificar senha
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Função para validar força da senha
function isPasswordStrong($password) {
    // Pelo menos 8 caracteres
    if (strlen($password) < 8) {
        return false;
    }
    
    // Pelo menos uma letra maiúscula
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    
    // Pelo menos uma letra minúscula
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    
    // Pelo menos um número
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    
    // Pelo menos um caractere especial
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
        return false;
    }
    
    return true;
}
?>
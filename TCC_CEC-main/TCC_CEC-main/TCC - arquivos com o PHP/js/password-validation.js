function validatePassword(password) {
    // Critérios de validação
    const minLength = password.length >= 8;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /[0-9]/.test(password);
    const hasSpecialChars = /[!@#$%^&*()\-_=+{};:,<.>]/.test(password);

    // Atualiza os indicadores visuais
    updateValidationIndicator('length', minLength);
    updateValidationIndicator('uppercase', hasUpperCase);
    updateValidationIndicator('lowercase', hasLowerCase);
    updateValidationIndicator('number', hasNumbers);
    updateValidationIndicator('special', hasSpecialChars);

    // Calcula a força da senha
    let strength = 0;
    if (minLength) strength++;
    if (hasUpperCase) strength++;
    if (hasLowerCase) strength++;
    if (hasNumbers) strength++;
    if (hasSpecialChars) strength++;

    // Atualiza a barra de progresso
    updatePasswordStrength(strength);

    // Retorna true se todos os critérios foram atendidos
    return minLength && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChars;
}

function updateValidationIndicator(criterionId, isValid) {
    const indicator = document.getElementById(`password-${criterionId}`);
    if (indicator) {
        indicator.classList.remove('text-danger', 'text-success');
        indicator.classList.add(isValid ? 'text-success' : 'text-danger');
        const icon = indicator.querySelector('i');
        if (icon) {
            icon.className = `bi ${isValid ? 'bi-check-circle-fill' : 'bi-x-circle-fill'}`;
        }
    }
}

function updatePasswordStrength(strength) {
    const progressBar = document.getElementById('password-strength-bar');
    if (progressBar) {
        const percentage = (strength / 5) * 100;
        progressBar.style.width = `${percentage}%`;
        progressBar.className = `progress-bar ${getStrengthClass(strength)}`;
        
        // Atualiza o texto da força
        const strengthText = document.getElementById('password-strength-text');
        if (strengthText) {
            strengthText.textContent = getStrengthText(strength);
            strengthText.className = `small ${getStrengthClass(strength)}`;
        }
    }
}

function getStrengthClass(strength) {
    if (strength <= 2) return 'bg-danger';
    if (strength <= 3) return 'bg-warning';
    if (strength <= 4) return 'bg-info';
    return 'bg-success';
}

function getStrengthText(strength) {
    if (strength <= 2) return 'Fraca';
    if (strength <= 3) return 'Média';
    if (strength <= 4) return 'Boa';
    return 'Forte';
}

// Função para mostrar/ocultar senha
function togglePasswordVisibility(inputId, toggleId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(toggleId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye-fill');
        toggleIcon.classList.add('bi-eye-slash-fill');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash-fill');
        toggleIcon.classList.add('bi-eye-fill');
    }
}
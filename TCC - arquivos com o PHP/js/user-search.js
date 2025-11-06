// Função para atualizar a lista de usuários
function updateUserList(searchTerm = '', page = 1) {
    // Mostra indicador de carregamento
    const userList = document.querySelector('.user-list');
    userList.innerHTML = '<div class="text-center p-4"><div class="spinner-border" role="status"></div></div>';
    // Determina o tipo de usuário a partir do atributo data-user-type do <body> (padrão 1)
    const tipo = document.body && document.body.dataset && document.body.dataset.userType ? document.body.dataset.userType : '1';

    // Faz a requisição AJAX
    fetch(`search_users.php?ajax=1&search=${encodeURIComponent(searchTerm)}&tipo=${encodeURIComponent(tipo)}&page=${page}`)
        .then(response => response.json())
        .then(data => {
            // Limpa a lista atual
            userList.innerHTML = '';

            // Se não houver resultados
            if (!data.users || data.users.length === 0) {
                const empty = document.createElement('div');
                empty.className = 'text-center p-4';
                empty.innerHTML = `<i class="bi bi-search" style="font-size: 2rem;"></i><p class="mt-2">Nenhum usuário encontrado</p>`;
                userList.appendChild(empty);
                updatePagination(1, 1);
                return;
            }

            // Adiciona cada usuário à lista (cria elementos de forma segura)
            data.users.forEach(user => {
                const row = document.createElement('div');
                row.className = 'user-row';

                const info = document.createElement('div');
                info.className = 'user-info';

                const name = document.createElement('span');
                name.className = 'user-name';
                name.textContent = user.nome;

                const email = document.createElement('span');
                email.className = 'user-email';
                email.textContent = user.email;

                info.appendChild(name);
                info.appendChild(email);

                const meta = document.createElement('div');
                meta.className = 'user-meta';
                const date = document.createElement('span');
                date.className = 'user-date small text-muted me-3';
                date.innerHTML = `<i class="bi bi-calendar3"></i> ${user.data_registro_formatada}`;
                meta.appendChild(date);

                row.appendChild(info);
                row.appendChild(meta);

                userList.appendChild(row);
            });

            // Atualiza a paginação
            updatePagination(data.current_page, data.pages);
        })
        .catch(error => {
            console.error('Erro ao buscar usuários:', error);
            userList.innerHTML = `
                <div class="text-center p-4 text-danger">
                    <i class="bi bi-exclamation-triangle" style="font-size: 2rem;"></i>
                    <p class="mt-2">Erro ao carregar usuários</p>
                </div>`;
        });
}

// Função para atualizar a paginação
function updatePagination(currentPage, totalPages) {
    const pagination = document.querySelector('.pagination');
    if (!pagination) return;

    let paginationHtml = '';
    
    // Botão anterior
    paginationHtml += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="event.preventDefault(); updateUserList('', ${currentPage - 1})" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>`;

    // Páginas
    for (let i = 1; i <= totalPages; i++) {
        if (
            i === 1 || // Primeira página
            i === totalPages || // Última página
            (i >= currentPage - 1 && i <= currentPage + 1) // Páginas próximas à atual
        ) {
            paginationHtml += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="event.preventDefault(); updateUserList('', ${i})">${i}</a>
                </li>`;
        } else if (
            (i === currentPage - 2 && currentPage > 3) ||
            (i === currentPage + 2 && currentPage < totalPages - 2)
        ) {
            paginationHtml += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
        }
    }

    // Botão próximo
    paginationHtml += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="event.preventDefault(); updateUserList('', ${currentPage + 1})" aria-label="Próximo">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>`;

    pagination.innerHTML = paginationHtml;
}

// Configura o campo de pesquisa
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        let debounceTimer;

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                updateUserList(this.value);
            }, 300); // Espera 300ms após o usuário parar de digitar
        });
    }

    // Carrega a lista inicial
    updateUserList();
    

    // Wire the clear button (if present) to reset the search and reload list
    const clearBtn = document.querySelector('.search-clear');
    if (clearBtn && searchInput) {
        // show/hide clear button depending on input
        const updateClearVisibility = () => {
            if (searchInput.value && searchInput.value.trim() !== '') {
                clearBtn.style.display = 'inline-flex';
            } else {
                clearBtn.style.display = 'none';
            }
        };

        // initial state
        updateClearVisibility();

        // toggle visibility on input
        searchInput.addEventListener('input', updateClearVisibility);

        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            updateClearVisibility();
            updateUserList('');
            searchInput.focus();
        });
    }
});

// Edit functionality removed per request (modal + update/delete removed)
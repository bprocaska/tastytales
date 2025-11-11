/**
 * Função para fazer logout via API
 */
async function logout() {
    try {
        // Pega o token do localStorage se existir
        const userData = localStorage.getItem("userData");
        let token = null;
        
        if (userData) {
            const user = JSON.parse(userData);
            token = user.token;
        }

        // Faz a requisição para a API de logout
        const response = await fetch('/tastytales/api/users/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'token': token || ''
            },
            body: JSON.stringify({})
        });
        
        const result = await response.json();

        // Se deu erro na API, mostra o erro mas ainda assim faz logout local
        if (!response.ok) {
            console.warn('Erro na API de logout:', result);
        }

        // Limpa todos os dados do localStorage independente da resposta
        localStorage.removeItem("userData");
        localStorage.removeItem("authToken");
        localStorage.clear();
        sessionStorage.clear();

        // Redireciona para a página de login
        window.location.href = '/tastytales/login';

    } catch (error) {
        console.error('Erro ao fazer logout:', error);
        
        // Mesmo com erro, limpa os dados locais e redireciona
        localStorage.removeItem("userData");
        localStorage.removeItem("authToken");
        localStorage.clear();
        sessionStorage.clear();
        
        window.location.href = '/tastytales/login';
    }
}

/**
 * Função para verificar se o usuário está logado
 */
function checkAuth() {
    const userData = localStorage.getItem("userData");
    
    if (!userData) {
        window.location.href = '/tastytales/login';
        return false;
    }
    
    try {
        const user = JSON.parse(userData);
        if (!user.token) {
            window.location.href = '/tastytales/login';
            return false;
        }
        return true;
    } catch (error) {
        console.error('Erro ao verificar autenticação:', error);
        window.location.href = '/tastytales/login';
        return false;
    }
}

// Event listener para o link de logout
document.addEventListener('DOMContentLoaded', function() {
    const logoutLink = document.getElementById('logout-link');
    
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('Tem certeza que deseja sair?')) {
                logout();
            }
        });
    }
});
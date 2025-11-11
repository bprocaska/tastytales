document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const messageBox = document.getElementById("loginMessage");

    loginForm.addEventListener("submit", async function (e) {
        e.preventDefault();
        console.log("Formulário enviado");

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        messageBox.innerHTML = "";

        // Validação básica no frontend
        if (!email || !password) {
            messageBox.innerHTML = "<p style='color:red;'>Preencha todos os campos.</p>";
            return;
        }

        try {
            // Debug: Vamos ver o que está sendo enviado
            const formData = new FormData(loginForm);
            console.log("=== DEBUG FormData ===");
            for (let [key, value] of formData.entries()) {
                console.log(key + ": " + value);
            }
            
            // CORRIGIDO: URL ajustada para corresponder à rota do /api/index.php
            const response = await fetch("api/users/login", {
                method: "POST",
                body: formData
            });

            console.log("Status da resposta:", response.status);
            console.log("Headers da resposta:", [...response.headers.entries()]);
            
            // Verificar se a resposta é JSON válida
            const contentType = response.headers.get("content-type");
            
            let result;
            try {
                const responseText = await response.text();
                console.log("Resposta raw:", responseText);
                
                if (contentType && contentType.includes("application/json")) {
                    result = JSON.parse(responseText);
                } else {
                    // Se não for JSON, pode ser erro do servidor/Apache
                    throw new Error(`Resposta não é JSON. Content-Type: ${contentType}. Response: ${responseText.substring(0, 200)}`);
                }
            } catch (parseError) {
                console.error("Erro ao fazer parse da resposta:", parseError);
                throw parseError;
            }
            
            console.log("Resposta da API (parsed):", result);

                if (response.status === 200 && result.status === "success") {
                    // Salvar token no localStorage
                    localStorage.setItem("authToken", result.data.token);
                    localStorage.setItem("userData", JSON.stringify(result.data.user));

                    messageBox.innerHTML = "<p style='color:green;'>Login bem-sucedido! Redirecionando...</p>";

                    setTimeout(() => {
                        const user = result.data.user;
                        if (user.idType == 1) {
                            // Se for administrador
                            window.location.href = "/tastytales/admin";
                        } else {
                            // Se for usuário normal
                            window.location.href = "/tastytales/app/profile";
                        }
                    }, 1500);
                }

             else {
                // Tratar diferentes tipos de erro
                let errorMessage = "Erro ao fazer login.";
                
                if (result.message) {
                    errorMessage = result.message;
                } else if (response.status === 401) {
                    errorMessage = "Email ou senha incorretos.";
                } else if (response.status === 400) {
                    errorMessage = "Dados inválidos fornecidos.";
                } else if (response.status === 403) {
                    errorMessage = "Acesso negado. Verifique suas credenciais.";
                } else if (response.status === 404) {
                    errorMessage = "Endpoint não encontrado. Verifique a URL da API.";
                } else if (response.status >= 500) {
                    errorMessage = "Erro interno do servidor. Tente novamente.";
                }
                
                console.error("Erro de login:", {
                    status: response.status,
                    message: result.message || "Sem mensagem",
                    data: result
                });
                
                messageBox.innerHTML = `<p style='color:red;'>${errorMessage}</p>`;
            }

        } catch (error) {
            console.error("Erro na requisição:", error);
            messageBox.innerHTML = "<p style='color:red;'>Erro ao conectar com o servidor. Verifique sua conexão e a URL da API.</p>";
        }
    });

    // Opcional: Limpar mensagens quando o usuário começar a digitar
    emailInput.addEventListener('input', function() {
        if (messageBox.innerHTML) {
            messageBox.innerHTML = "";
        }
    });

    passwordInput.addEventListener('input', function() {
        if (messageBox.innerHTML) {
            messageBox.innerHTML = "";
        }
    });
});
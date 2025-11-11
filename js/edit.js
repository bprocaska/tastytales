 document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const nomeInput = document.getElementById("nome");
    const senhaInput = document.getElementById("senha");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const userData = JSON.parse(localStorage.getItem("userData"));
        if (!userData) {
            alert("Você precisa estar logado para editar o perfil.");
            window.location.href = `${window.location.origin}/tastytales/login`;
            return;
        }

        // Verificação básica dos campos
        if (!nomeInput.value.trim()) {
            alert("Nome é obrigatório.");
            return;
        }

        if (!senhaInput.value.trim()) {
            alert("Senha é obrigatória.");
            return;
        }

        const payload = {
            name: nomeInput.value.trim(),
            senha: senhaInput.value.trim()
        };

        console.log("Payload enviado:", payload);
        console.log("Token no localStorage:", localStorage.getItem("authToken"));

        try {
            const response = await fetch("/tastytales/api/users/update", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "token": localStorage.getItem("authToken")
                },
                body: JSON.stringify(payload)
            });

            console.log("Status da resposta:", response.status);
            console.log("Headers da resposta:", [...response.headers.entries()]);
            console.log(nomeInput, senhaInput);
            
            // Primeiro pega o texto bruto da resposta
            const responseText = await response.text();
            console.log("Resposta bruta:", responseText);
            
            // Tenta fazer o parse do JSON apenas se não estiver vazio
            let result;
            try {
                result = responseText ? JSON.parse(responseText) : {};
                console.log("Resposta parseada:", result);
            } catch (parseError) {
                console.error("Erro ao parsear JSON:", parseError);
                console.log("Texto que causou erro:", responseText);
                alert("Erro na resposta do servidor: resposta inválida");
                return;
            }

            if (response.ok && result.status === "success") {
                alert("Nome atualizado com sucesso!");
                
                // Atualiza localStorage
                userData.name = payload.name;
                localStorage.setItem("userData", JSON.stringify(userData));
                
                window.location.href = "/tastytales/app/profile";
            } else {
                alert(result.message || "Erro ao atualizar perfil.");
            }
        } catch (error) {
            console.error("Erro na atualização:", error);
            alert("Não foi possível atualizar agora. Verifique o console para mais detalhes.");
        }
    });
});  

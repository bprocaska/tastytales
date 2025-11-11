document.getElementById("register-form").addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmar = document.getElementById("confirmar").value;

    if (!name || !email || !password) {
        alert("Preencha todos os campos.");
        return;
    }
    if (password !== confirmar) {
        alert("Senhas não coincidem.");
        return;
    }

    try {
        const response = await fetch("<?= url('/api/usuarios') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                idType: 2, // usuário comum
                name,
                email,
                password
            }),
        });

        const data = await response.json();

        if (response.ok) {
            alert("Usuário criado com sucesso!");
            window.location.href = "<?= url('/login') ?>";
        } else {
            alert(`Erro: ${data.message || "Não foi possível criar o usuário."}`);
        }
    } catch (error) {
        alert("Erro na conexão, tente novamente.");
        console.error(error);
    }
});

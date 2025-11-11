 document.addEventListener("DOMContentLoaded", () => {
    const userData = localStorage.getItem("userData");

    try {
        const user = JSON.parse(userData);

        // Preenche os elementos do perfil
        document.querySelector(".valuenome").textContent = user.name || "Usuário sem nome";
        document.querySelector(".valueemail").textContent = user.email || "Email não disponível";

    } catch (err) {
        console.error("Erro ao carregar userData:", err);
        window.location.href = "/tastytales/app/login";
    }
});

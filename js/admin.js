document.addEventListener("DOMContentLoaded", function () {
  const botoesExcluir = document.querySelectorAll(".excluir-btn");

  botoesExcluir.forEach(function(botao) {
    botao.addEventListener("click", function() {
      if (confirm("Tem certeza que deseja excluir esta receita?")) {
        const card = this.closest(".receita-card");
        if (card) {
          card.remove();
        }
      }
    });
  });
});

 <?php
$this->layout("_theme", []);
?>
  <h1>Sugestões dos Usuários</h1>
    <div class="comentarios-container">
      <div class="comentario-card">
        <h3>Gabriel Krever</h3>
        <p>Seria ótimo ver uma receita de lasanha vegana com abobrinha!</p>
      </div>
      <div class="comentario-card">
        <h3>Pedro Files</h3>
        <p>Poderiam postar uma receita de sorvete caseiro sem lactose?</p>
      </div>
      <div class="comentario-card">
        <h3>Luisa Borba</h3>
        <p>Adoraria uma receita de pão caseiro integral bem fofinho!</p>
      </div>
      <div class="comentario-card">
        <h3>Julia Borba</h3>
        <p>Quero ver receitas rápidas com frango desfiado!</p>
      </div>
      <div class="comentario-card">
        <h3>Fábio Santos</h3>
        <p>Vocês poderiam ensinar a fazer uma feijoada light?</p>
      </div>
    </div>

     <?php  $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url("/css/admsugest.css"); ?>">
    <?php $this->end(); ?>
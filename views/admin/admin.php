<?php
$this->layout("_theme", []);
?>

<h1>Administração de Receitas</h1>

<section class="adicionar-receita">
  <h2>Adicionar Nova Receita</h2>
  <form>
    <input type="text" placeholder="Nome da Receita" required>
    <input type="text" placeholder="URL da Imagem" required>
    <input type="text" placeholder="Tempo de preparo" required>
    <input type="text" placeholder="Ingredientes" required>
    <input type="text" placeholder="Modo de preparo" required>
    <button type="submit">Adicionar</button>
  </form>
</section>

<section class="lista-receitas">
  <h2>Receitas Existentes</h2>
  <div class="grid-receitas">
    
    <div class="receita-card">
      <div class="receita-img">
        <img src="<?= url('/imagens/bolo.jpg') ?>" alt="Bolo de Cenoura">
      </div>
      <p>Bolo de Cenoura</p>
      <button class="excluir-btn">Excluir</button>
    </div>

    <div class="receita-card">
      <div class="receita-img">
        <img src="<?= url('/imagens/feijoada.jpg') ?>" alt="Feijoada">
      </div>
      <p>Feijoada</p>
      <button class="excluir-btn">Excluir</button>
    </div>

    <div class="receita-card">
      <div class="receita-img">
        <img src="<?= url('/imagens/smoothie.jpg') ?>" alt="Smoothie de Frutas">
      </div>
      <p>Smoothie de Frutas</p>
      <button class="excluir-btn">Excluir</button>
    </div>

  </div>
</section>

<?php $this->start("specific-css"); ?>
  <link rel="stylesheet" href="<?= url('/css/admin.css') ?>">
<?php $this->end(); ?>
<?php  $this->start("specific-script"); ?>
    <script src="<?= url("js/admin.js"); ?>"></script>
<?php $this->end(); ?>

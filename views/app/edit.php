 <?php $this->layout("_theme", [
    "title" => $title ?? "Editar perfil - TastyTales"
]); ?>

<div class="edit-page-wrapper">
    <div class="edit-form-container">
        <h1>Editar Perfil</h1>
        <form action="#" method="POST" enctype="multipart/form-data">
          <label for="nome">Novo nome de usuário:</label>
          <input type="text" id="nome" name="nome" placeholder="Digite seu novo nome" required />
          
          <label for="foto">Nova foto de perfil:</label>
          <input type="file" id="foto" name="foto" accept="image/*" />
          
          <label for="senha">Senha:</label>
          <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required />
          
          <button type="submit">Salvar</button>
        </form>
    </div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/editarperfil.css') ?>">
<?php $this->end(); ?>

<?php $this->start("specific-script"); ?>
    <script src="<?= url('/js/edit.js'); ?>"></script>
<?php $this->end(); ?>  

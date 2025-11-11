<?php
$this->layout("_theme", [
    "title" => $title ?? "Perfil - TastyTales"
]);
?>

<div class="profile-container">
    <img src="<?= url('/imagens/pessoaicone.jpg') ?>" alt="Avatar" class="avatar" />
    <div class="profile-info">
        <p class="label">Nome de usuário:</p>
        <p class="valuenome"></p>
        <p class="label">Email cadastrado:</p>
        <p class="valueemail"></p>
        <a href="<?= url('/app/editar') ?>" class="editar-btn">Editar Perfil</a>
    </div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/perfil.css') ?>">
<?php $this->end(); ?>

<?php $this->start("specific-script"); ?>
    <script src="<?= url('/js/profile.js'); ?>"></script>
<?php $this->end(); ?>  

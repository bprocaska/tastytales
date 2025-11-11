<?php
$this->layout("_theme", [
    "title" => $title ?? "Sobre Nós - TastyTales"
]);
?>

<section class="sobre-nos">
    <h1>A VONTADE DE UNIR SABORES E MEMÓRIAS EM UM LUGAR SÓ.</h1>
    <p class="descricao">
        Criamos o <strong>TastyTales</strong> para armazenar aquelas receitas que passam de geração em geração e descobrir novos sabores que merecem ser lembrados.
    </p>

    <h2>QUEM SOMOS NÓS?</h2>
    <div class="cards">
        <div class="card">
            <img src="<?= url('/imagens/brenaicone.jpg') ?>" alt="Brenda" class="perfil" />
            <h3>Brenda Procaska</h3>
            <span>51 99877-5640</span>
        </div>
        <div class="card">
            <img src="<?= url('/imagens/mariicone.png') ?>" alt="Mariana" class="perfil" />
            <h3>Mariana Meyer</h3>
            <span>51 99651-9478</span>
        </div>
    </div>
</section>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/sobrenos.css') ?>">
<?php $this->end(); ?>
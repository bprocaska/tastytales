<?php
$this->layout("_theme", [
    "title" => $title ?? "Home - TastyTales"
]);
?>

<section class="banner">
    <img src="<?= url('/imagens/fundohome.png') ?>">
</section>

<section class="categorias">
    <h2>Categorias Populares</h2>
    <div class="icones">
        <div><img src="<?= url('/imagens/saladaicone.png') ?>" alt="Saladas"><p>Saladas</p></div>
        <div><img src="<?= url('/imagens/sobremesaicone.png') ?>" alt="Sobremesas"><p>Sobremesas</p></div>
        <div><img src="<?= url('/imagens/lancheicone.png') ?>" alt="Lanches"><p>Lanches</p></div>
        <div><img src="<?= url('/imagens/bebidasicone.png') ?>" alt="Bebidas"><p>Bebidas</p></div>
        <div><img src="<?= url('/imagens/massaicone.png') ?>" alt="Massas"><p>Massas</p></div>
    </div>
</section>

<section class="receitas">
    <h2>Receitas Doces</h2>
    <div class="grid-receitas">
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/brigadeiro.jpg') ?>" alt="Brigadeiro">
            </div>
            Brigadeiro
            <a href="<?= url('/receita/brigadeiro') ?>" class="btn-receita">Ver Receita</a>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/bolo.jpg') ?>" alt="Bolo de Cenoura">
            </div>
            Bolo de Cenoura
            <a href="<?= url('/receita/bolo') ?>" class="btn-receita">Ver Receita</a>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/pave.jpg') ?>" alt="Pavê">
            </div>
            Pavê
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/mousse.jpg') ?>" alt="Mousse de Maracujá">
            </div>
            Mousse de Maracujá
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
    </div>

    <h2>Receitas Salgadas</h2>
    <div class="grid-receitas">
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/lasanha.jpg') ?>" alt="Lasanha">
            </div>
            Lasanha
            <a href="<?= url('/receita/lasanha') ?>" class="btn-receita">Ver Receita</a>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/feijoada.jpg') ?>" alt="Feijoada">
            </div>
            Feijoada
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/escondidinho.jpg') ?>" alt="Escondidinho">
            </div>
            Escondidinho
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/empada.jpg') ?>" alt="Empadão">
            </div>
            Empadão
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
    </div>

    <h2>Bebidas</h2>
    <div class="grid-receitas">
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/sucodetox.jpg') ?>" alt="Suco Detox">
            </div>
            Suco Detox
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/capuccino.jpg') ?>" alt="Capuccino">
            </div>
            Capuccino
            <a href="<?= url('/receita/capuccino') ?>" class="btn-receita">Ver Receita</a>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/caipirinha.jpg') ?>" alt="Caipirinha">
            </div>
            Caipirinha
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
        <div class="receita-card">
            <div class="receita-img">
                <img src="<?= url('/imagens/smoothie.jpg') ?>" alt="Smoothie de Frutas">
            </div>
            Smoothie de Frutas
            <button class="btn-receita" onclick="alert('Receita em breve!')">Ver Receita</button>
        </div>
    </div>
</section>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/home.css') ?>">
<style>
/* Estilo para botões como links */
.btn-receita {
    display: inline-block;
    padding: 8px 16px;
    background-color: #e74c3c;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

.btn-receita:hover {
    background-color: #c0392b;
}
</style>
<?php $this->end(); ?>
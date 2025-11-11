   <?php
$this->layout("_theme", []);
?>

 <section class="assinatura">
      <div class="oferta">
        <h2>O que o plano <span>Premium Taste+</span><br>oferece?</h2>
        <ul>
          <li>→ Receitas exclusivas de grandes chefs de cozinha;</li>
          <li>→ Informações privilegiadas sobre os ingredientes utilizados;</li>
          <li>→ Vídeos estratégicos sobre receitas específicas;</li>
        </ul>
        <img src="../imagens/cereja.png" alt="Limão" class="limao">
        <img src="../imagens/limao.png" alt="Cereja" class="cereja">
      </div>

      <div class="chamada">
        <h1>Assine já!</h1>
        <p>E não fique de fora dessa</p>
        <p class="preco">R$29,90 mensais</p>
        <button>Assine aqui</button>
      </div>
    </section>

    <?php  $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url("/css/assinatura.css"); ?>">
    <?php $this->end(); ?>
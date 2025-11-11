<?php
$this->layout("_theme", [
    "title" => $title ?? "Sugestoes - TastyTales"
]);
?>

<div class="sugestao-container">
    <h1>Queremos ouvir sua opinião!</h1>
    <p>Há alguma receita específica<br> que gostaria de aprender?</p>

    <div class="sugestao-form">
  <form action="#" method="POST">
    <input type="text" placeholder="Me conta!" name="sugestao" required />
    <button type="submit" class="btn-enviar">Enviar</button>
  </form>
</div>


    <div class="descricao">
      <p>Deposite aqui o que você deseja que seja sua<br>
      próxima descoberta culinária</p>
    </div>
  </div>

  <?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/sugestoes.css') ?>">
<?php $this->end(); ?>
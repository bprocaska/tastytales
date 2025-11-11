<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TastyTales - Home</title>
  <link rel="stylesheet" href="<?= url('/css/_theme.css') ?>" />
  
</head>
<body>
  <header>
    <img src="<?= url('/imagens/logo.png') ?>" alt="Logo TastyTales" class="logo" />
    <nav>
      <ul>
        <li><a href="<?= url('/app') ?>">Home</a></li>
        <li><a href="<?= url('/app/sugestoes') ?>">Sugestões</a></li>
        <li><a href="<?= url('/app/sobrenos') ?>">Sobre Nós</a></li>
        <li><a href="<?= url('/app/assinatura') ?>">Premium Taste+</a></li>
        <li><a href="<?= url('/app/profile') ?>">Perfil</a></li>
        <li><a href="#" id="logout-link"><img src="<?= url('/imagens/sair.png') ?>" alt="Sair" /></a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <?= $this->section("content") ?>
  </main>

  <script src="<?= url('/js/logout.js'); ?>"></script>

  <?php if ($this->section("specific-css")): ?>
    <?= $this->section("specific-css"); ?>
  <?php endif; ?>

  <?php if ($this->section("specific-script")): ?>
    <?= $this->section("specific-script"); ?>
  <?php endif; ?>
</body>
</html>

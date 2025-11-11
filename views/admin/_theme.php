<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Administração - TastyTales</title>

  <link rel="stylesheet" href="<?= url('/css/_theme.css') ?>">
  
  <?php if ($this->section("specific-css")): ?>
    <?= $this->section("specific-css"); ?>
  <?php endif; ?>
</head>

<body>
  <header>
    <img src="<?= url('/imagens/logo.png') ?>" alt="Logo TastyTales" class="logo">

    <nav>
      <ul>
        <li><a href="<?= url('/admin') ?>">Home</a></li>
        <li><a href="<?= url('/admin/sugestoes') ?>">Sugestões</a></li>
        <li><a href="#" id="logout-link"><img src="<?= url('/imagens/sair.png') ?>" alt="Sair" /></a></li>
      </ul>
    </nav>
  </header>

  <main class="admin-container">
    <?= $this->section("content") ?>
  </main>

    <script src="<?= url('/js/logout.js'); ?>"></script>

  <?php if ($this->section("specific-script")): ?>
    <?= $this->section("specific-script"); ?>
  <?php endif; ?>
</body>
</html>

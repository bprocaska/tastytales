<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "TastyTales" ?></title>
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
                <li><a href="<?= url('/') ?>">Home</a></li>
                <li><a href="<?= url('/sobre') ?>">Sobre Nós</a></li>
                <li><a href="<?= url('/login') ?>">Login/Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <main class="form-container">
        <?= $this->section("content") ?>
    </main>

    <?php if ($this->section("specific-script")): ?>
        <?= $this->section("specific-script"); ?>
    <?php endif; ?>
</body>
</html>
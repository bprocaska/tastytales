<?php $this->layout("_theme", [
    "title" => $title ?? "Login - TastyTales"
]); ?>

<div class="container">
<div class="login-box">
    <h2>Bem-vindo/a!</h2>
    <form id="loginForm">
        <div class="input-group">
            <input id="email" name="email" type="email" required>
            <label>Email</label>
        </div>
        <div class="input-group">
            <input id="password" name="password" type="password" required>
            <label>Senha</label>
        </div>
        <button class="login-button" type="submit">Entrar</button>
    </form>
    <div class="register-link">
        Ainda não possui uma conta? <a href="<?= url('/cadastro') ?>">Cadastre-se!</a>
        <br>
        <a href="<?= url('/confirmEmail') ?>">Esqueci minha senha</a>
    </div>
    
    <div id="loginMessage"></div>
</div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/login.css') ?>">
<?php $this->end(); ?>

<?php $this->start("specific-script"); ?>
    <script src="<?= url("js/login.js"); ?>"></script>
<?php $this->end(); ?>
<?php $this->layout("_theme", []); ?>

<div class="container">
    <div class="register-box">
        <form id="registerForm" method="POST">
            <div class="input-group">
                <input id="name" type="text" name="name" required />
                <label>Nome de usuário</label>
            </div>
            <div class="input-group">
                <input id="email" type="email" name="email" required />
                <label>Email</label>
            </div>
            <div class="input-group">
                <input id="password" type="password" name="password" required />
                <label>Senha</label>
            </div>
            <button class="register-button" type="submit">Cadastrar</button>
            <div id="registerMessage"></div> 
        </form>
        <div class="register-link">
            Já criou sua conta? <a href="<?= url('/login') ?>">Entre!</a>
        </div>
    </div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url("/css/cadastro.css"); ?>">
<?php $this->end(); ?>

<?php  $this->start("specific-script"); ?>
    <script src="<?= url("js/register.js"); ?>"></script>
<?php $this->end(); ?>

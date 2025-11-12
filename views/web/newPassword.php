<?php $this->layout("_theme", [
    "title" => $title ?? "Nova Senha - TastyTales"
]); ?>

<div class="container">
    <div class="login-box">
        <h2>Criar Nova Senha</h2>
        <form>
            <div class="register-link">
                Crie uma nova senha segura para sua conta
            </div>
            <br>
            <div class="input-group">
                <input type="password" required>
                <label>Nova Senha</label>
            </div>
            <button class="login-button" type="submit">Salvar</button>
        </form>
    </div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/newPassword.css') ?>">
<?php $this->end(); ?>

<?php $this->start("specific-script"); ?>
<script src="<?= url('/js/recovery.js') ?>"></script>
<?php $this->end(); ?>

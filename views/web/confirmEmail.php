<?php $this->layout("_theme", [
"title" => $title ?? "Nova senha - TastyTales"
]); ?>

<div class="container">
<div class="login-box">
<h2>Esqueceu a senha?</h2>
<form>
<div class="register-link">
Não se preocupe, insira aqui seu email próprio para receber um código de verificação e alterar sua senha.
</div>
<br>
<div class="input-group">
<input type="text" required>
<label>Email</label>
</div>
<button class="login-button" type="submit">Prosseguir</button>
</form>

</div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/confirmEmail.css') ?>">
<?php $this->end(); ?>

<?php $this->start("specific-script"); ?>
<script src="<?= url('/js/recovery.js') ?>"></script>
<?php $this->end(); ?>

<?php $this->layout("_theme", [
    "title" => $title ?? "Verificar Código - TastyTales"
]); ?>

<div class="verify-container">
    <h1>Verificar Código</h1>
    <p class="subtitle">
        Digite o código de 6 dígitos enviado para seu email
    </p>

    <div id="errorMessage" class="error-message"></div>
    <div id="successMessage" class="success-message"></div>
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>

    <form id="verifyForm">
        <div class="code-inputs">
            <input type="text" class="code-input" maxlength="1" required>
            <input type="text" class="code-input" maxlength="1" required>
            <input type="text" class="code-input" maxlength="1" required>
            <input type="text" class="code-input" maxlength="1" required>
            <input type="text" class="code-input" maxlength="1" required>
            <input type="text" class="code-input" maxlength="1" required>
        </div>

        <button class="verify-btn" id="verifyBtn" type="submit">Verificar</button>
    </form>

    <div class="actions">
        <p>
            Não recebeu o código?
            <button id="resendBtn" class="link-btn">Reenviar</button>
        </p>
    </div>
</div>

<?php $this->start("specific-css"); ?>
<link rel="stylesheet" href="<?= url('/css/code.css') ?>">
<?php $this->end(); ?>

<?php $this->start("specific-script"); ?>
<script src="<?= url('/js/recovery.js') ?>"></script>
<?php $this->end(); ?>

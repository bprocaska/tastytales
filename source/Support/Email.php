<?php

namespace Source\Support;

require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'marianapanassolo.ch005@academico.ifsul.edu.br';
            $this->mail->Password   = 'levychwrwdlcfxjx'; // senha de app do Gmail
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port       = 587;
            $this->mail->CharSet    = 'UTF-8';
            $this->mail->setFrom('marianapanassolo.ch005@academico.ifsul.edu.br', 'TastyTales');
        } catch (Exception $e) {
            error_log("❌ Erro ao configurar PHPMailer: " . $e->getMessage());
        }
    }

    // =====================================================
    // RECUPERAÇÃO DE SENHA
    // =====================================================
    public function enviarCodigoRecuperacao($emailDestino, $codigo, $nomeUsuario = '')
    {
        try {
            $this->mail->clearAllRecipients();
            $this->mail->addAddress($emailDestino);
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Recuperação de Senha - TastyTales';

            $this->mail->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto;'>
                    <h2 style='color: #2c1c1c;'>Recuperação de Senha</h2>
                    <p>Olá" . ($nomeUsuario ? " {$nomeUsuario}" : "") . ",</p>
                    <p>Use o código abaixo para redefinir sua senha:</p>
                    <div style='background: #f5f5f5; padding: 20px; text-align: center; border-radius: 10px; margin: 20px 0;'>
                        <h1 style='color: #6b954e; font-size: 36px; letter-spacing: 8px; margin: 0;'>{$codigo}</h1>
                    </div>
                    <p style='font-size: 14px; color: #666;'>Código expira em 15 minutos.</p>
                </div>
            ";

            $this->mail->AltBody = "Seu código de recuperação é: {$codigo}.";

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("❌ Erro ao enviar e-mail de recuperação: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}

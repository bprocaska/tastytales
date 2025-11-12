<?php

namespace Source\Support;

class Uploader
{
    private $message;
    private $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    private $maxSize = 5242880; // 5MB em bytes

    /**
     * Faz upload de uma imagem
     * @param array $file - Array do $_FILES
     * @return string|false - Retorna o nome do arquivo ou false em caso de erro
     */
    public function Image($file)
    {
        // Verifica se o arquivo foi enviado
        if (empty($file['name'])) {
            $this->message = "Nenhum arquivo foi enviado";
            return false;
        }

        // Verifica se houve erro no upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->message = "Erro ao fazer upload do arquivo";
            return false;
        }

        // Verifica o tamanho do arquivo
        if ($file['size'] > $this->maxSize) {
            $this->message = "Arquivo muito grande. Tamanho máximo: 5MB";
            return false;
        }

        // Pega a extensão do arquivo
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Verifica se a extensão é permitida
        if (!in_array($extension, $this->allowedExtensions)) {
            $this->message = "Formato de arquivo não permitido. Use: " . implode(', ', $this->allowedExtensions);
            return false;
        }

        // Verifica se é realmente uma imagem
        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            $this->message = "O arquivo não é uma imagem válida";
            return false;
        }

        // Gera um nome único para o arquivo
        $fileName = md5(uniqid(rand(), true)) . '.' . $extension;

        // Define o caminho completo onde a imagem será salva
        $uploadDir = __DIR__ . '/../../storage/images/';
        
        // Cria a pasta se não existir
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fullPath = $uploadDir . $fileName;

        // Move o arquivo para o diretório final
        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            $this->message = "Upload realizado com sucesso";
            return $fileName; // Retorna apenas o nome do arquivo
        } else {
            $this->message = "Erro ao mover o arquivo para o diretório final";
            return false;
        }
    }

    /**
     * Retorna a mensagem de erro/sucesso
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Deleta uma imagem
     * @param string $fileName - Nome do arquivo a ser deletado
     * @return bool
     */
    public function deleteImage($fileName)
    {
        if (empty($fileName)) {
            return false;
        }

        $filePath = __DIR__ . '/../../storage/images/' . $fileName;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }
}

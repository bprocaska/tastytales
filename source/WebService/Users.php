<?php

namespace Source\WebService;

use Source\Models\User;
use Source\Core\JWTToken;

class Users extends Api
{
    public function login(array $data): void
    {
        // Verificar se os dados de login foram fornecidos
        // Agora usando $data ao invés de $this->headers
        if (empty($data["email"]) || empty($data["password"])) {
            $this->call(400, "bad_request", "Credenciais inválidas", "error")->back();
            return;
        }

        $user = new User();

        if(!$user->findByEmail($data["email"])){
            $this->call(401, "unauthorized", "Usuário não encontrado", "error")->back();
            return;
        }

        if(!password_verify($data["password"], $user->getPassword())){
            $this->call(401, "unauthorized", "Senha inválida", "error")->back();
            return;
        }

        // Gerar o token JWT
        $jwt = new JWTToken();
        $token = $jwt->create([
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "idType" => $user->getIdType()
        ]);

        // Retornar o token JWT na resposta
        $this->call(200, "success", "Login realizado com sucesso", "success")
            ->back([
                "token" => $token,
                "user" => [
                    "id" => $user->getId(),
                    "idType" => $user->getIdType(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "photo" => $user->getPhoto()
                ]
            ]);
    }
    
    // Resto dos métodos permanecem iguais...
    public function listUsers(): void
    {
        $users = new User();
        $this->call(200, "success", "Lista de usuários", "success")
            ->back($users->findAll());
    }

    public function createUser(array $data): void
    {
        $requiredFields = ["idType", "name", "email", "password"];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $this->call(400, "bad_request", "Campo '{$field}' é obrigatório", "error")->back();
                return;
            }
        }      

        $user = new User(
            null,
            $data["idType"],
            $data["name"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT),
            $data["photo"] ?? null
        );

        if (!$user->insert()) {
            $this->call(500, "internal_server_error", $user->getErrorMessage(), "error")->back();
            return;
        }

        $response = [
            "id" => $user->getId(),
            "idType" => $user->getIdType(),
            "name" => $user->getName(),
            "email" => $user->getEmail(),
        ];

        $this->call(201, "created", "Usuário criado com sucesso", "success")->back($response);
    }

public function updateUser(): void
{
    header("Content-Type: application/json; charset=UTF-8");

    $json = file_get_contents("php://input");
    $body = json_decode($json, true);

    if (!$body) {
        echo json_encode(["status" => "error", "message" => "Nenhum dado enviado"]);
        return;
    }

    // Recupera token do header
    $headers = getallheaders();
    $token = $headers["token"] ?? null;

    if (!$token) {
        echo json_encode(["status" => "error", "message" => "Token não enviado"]);
        return;
    }

    // ✅ Decodifica o token
    $jwt = new JWTToken();
    $data = $jwt->decode($token);

    if (!$data || empty($data->data->id)) {
        echo json_encode(["status" => "error", "message" => "Token inválido ou expirado"]);
        return;
    }

    $userId = $data->data->id;

    // Carrega usuário do banco
    $user = new User();
    if (!$user->findById($userId)) {
        echo json_encode(["status" => "error", "message" => "Usuário não encontrado"]);
        return;
    }

    // Verifica a senha atual antes de atualizar
    if (empty($body["senha"]) || !$user->verifyPassword($body["senha"])) {
        echo json_encode(["status" => "error", "message" => "Senha incorreta"]);
        return;
    }

    // Atualiza campos
    if (!empty($body["name"])) {
        $user->setName($body["name"]);
    }

    if (!empty($body["newPassword"])) {
        $user->setPassword($body["newPassword"]);
    }

    if (!empty($body["photo"])) {
        $user->setPhoto($body["photo"]);
    }

    // Persiste atualização
    if ($user->updateById()) {
        echo json_encode([
            "status" => "success",
            "message" => "Perfil atualizado com sucesso",
            "user" => [
                "id" => $user->getId(),
                "idType" => $user->getIdType(),
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => $user->getPhoto()
            ]
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => $user->getErrorMessage() ?? "Erro ao atualizar perfil"
        ]);
    }
}



    public function deleteUser(): void
    {
        $this->auth();

        $user = new User();
        if (!$user->findById($this->userAuth->id)) {
            $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
            return;
        }

        $user->setDeleted(true);

        if (!$user->updateById()) {
            $this->call(500, "internal_server_error", "Erro ao deletar usuário", "error")->back();
            return;
        }

        $this->call(200, "success", "Usuário deletado com sucesso", "success")->back();
    }

    public function listUserById(array $data): void
    {
        if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $user = new User();
        if (!$user->findById($data["id"])) {
            $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
            return;
        }

        $response = [
            "id" => $user->getId(),
            "idType" => $user->getIdType(),
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "photo" => $user->getPhoto()
        ];

        $this->call(200, "success", "Usuário encontrado", "success")->back($response);
    }

    public function updatePhoto (): void
    {
        $this->auth();

        $photo = (!empty($_FILES["photo"]["name"]) ? $_FILES["photo"] : null);

        $upload = new Uploader();
        // /storage/images/091da97a9aec86fe9905ecf532508cd4.png
        $path = $upload->Image($photo);
        if(!$path) {
            $this->call(400, "bad_request", $upload->getMessage(), "error")->back();
            return;
        }

        $user = new User();
        $user->findByEmail($this->userAuth->email);
        // Deletar a foto antiga
        if(file_exists(__DIR__ . "/../../storage/images/" . "{$user->getPhoto()}")){
            unlink(__DIR__ . "/../../storage/images/" . "{$user->getPhoto()}");
        }

        $user->setPhoto($path);
        if(!$user->updateById()){
            $this->call(500, "internal_server_error", $user->getErrorMessage(), "error")->back();
            return;
        }

        $this->call(200, "success", "Foto atualizada com sucesso", "success")->back();

    }

    
    // ... seus outros métodos existentes ...

    /**
     * Método para fazer logout do usuário
     */
    public function logout(): void
    {
        try {
            // Debug - verificar se chegou na função
            error_log("Método logout chamado");
            
            // Verifica o método da requisição
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->call(405, "method_not_allowed", "Método não permitido", "error")->back();
                return;
            }

            // Limpa qualquer sessão PHP se estiver usando
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_unset();
                session_destroy();
                error_log("Sessão PHP limpa");
            }

            // Remove cookies se existirem
            if (isset($_COOKIE['authToken'])) {
                setcookie('authToken', '', time() - 3600, '/');
                error_log("Cookie removido");
            }

            // Retorna resposta de sucesso
            $this->call(200, "success", "Logout realizado com sucesso", "success")->back([
                "message" => "Usuário deslogado com sucesso"
            ]);
            
        } catch (Exception $e) {
            error_log("Erro no logout: " . $e->getMessage());
            $this->call(500, "internal_server_error", "Erro interno no logout", "error")->back();
        }
    }

    // ... resto dos seus métodos ...
}


<?php

namespace Source\Models;

use Source\Core\Connect;
use Source\Core\Model;
use PDO;
use PDOException;

class User extends Model 
{
    protected $id;
    protected $idType;
    protected $name;
    protected $email;
    protected $password;
    protected $photo;
    protected $errorMessage;

    public function __construct(
        int $id = null,
        int $idType = null,
        string $name = null,
        string $email = null,
        string $password = null,
        string $photo = null
    )
    {
        $this->table = "users";
        $this->id = $id;
        $this->idType = $idType;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->photo = $photo;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    // Setters
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setIdType(?int $idType): void
    {
        $this->idType = $idType;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    public function login(): void 
    {
        echo "Olá, {$this->name}! Você está logado!";
    }

    public function insert(): bool
    {
        // Validação de e-mail
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessage = "E-mail inválido";
            return false;
        }

        // Verificar se e-mail já existe
        if ($this->emailExists($this->email)) {
            $this->errorMessage = "E-mail já cadastrado";
            return false;
        }

        // Hash da senha APENAS se ainda não estiver hasheada
        if (!password_get_info($this->password)['algo']) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        try {
            $sql = "INSERT INTO {$this->table} (idType, name, email, password, photo) VALUES (:idType, :name, :email, :password, :photo)";
            $stmt = Connect::getInstance()->prepare($sql);
            
            $stmt->bindValue(":idType", $this->idType, PDO::PARAM_INT);
            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $this->password, PDO::PARAM_STR);
            $stmt->bindValue(":photo", $this->photo, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $this->id = Connect::getInstance()->lastInsertId();
                return true;
            }
            
            $this->errorMessage = "Erro ao inserir usuário";
            return false;
            
        } catch (PDOException $e) {
            $this->errorMessage = "Erro ao inserir o registro: {$e->getMessage()}";
            return false;
        }
    }

    public function findByEmail(string $email): bool
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE email = :email";
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            if (!$result) {
                return false;
            }

            $this->id = (int)$result->id;
            $this->idType = (int)$result->idType;
            $this->name = $result->name;
            $this->email = $result->email;
            $this->password = $result->password;
            $this->photo = $result->photo;

            return true;
            
        } catch (PDOException $e) {
            $this->errorMessage = "Erro ao buscar o registro: {$e->getMessage()}";
            return false;
        }
    }

    public function findById(int $id): bool
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            if (!$result) {
                return false;
            }

            $this->id = (int)$result->id;
            $this->idType = (int)$result->idType;
            $this->name = $result->name;
            $this->email = $result->email;
            $this->password = $result->password;
            $this->photo = $result->photo;

            return true;
            
        } catch (PDOException $e) {
            $this->errorMessage = "Erro ao buscar o registro: {$e->getMessage()}";
            return false;
        }
    }

    public function findAll(): array
    {
        try {
            $sql = "SELECT u.id, u.idType, u.name, u.email, u.photo, ut.description as type_description 
                    FROM {$this->table} u 
                    LEFT JOIN users_types ut ON u.idType = ut.id 
                    ORDER BY u.name";
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (PDOException $e) {
            $this->errorMessage = "Erro ao buscar registros: {$e->getMessage()}";
            return [];
        }
    }

    public function updateById(): bool
{
    try {
        // Verificar se o email já existe para outro usuário
        if ($this->email) {
            $sql = "SELECT COUNT(*) FROM {$this->table} WHERE email = :email AND id != :id";
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->fetchColumn() > 0) {
                $this->errorMessage = "E-mail já está em uso por outro usuário";
                return false;
            }
        }

        $sql = "UPDATE {$this->table} SET idType = :idType, name = :name, email = :email";
        
        $params = [
            ":idType" => $this->idType,
            ":name" => $this->name,
            ":email" => $this->email,
            ":id" => $this->id
        ];

        // Só atualiza a senha se foi fornecida
        if ($this->password !== null) {
            if (!password_get_info($this->password)['algo']) {
                $sql .= ", password = :password";
                $params[":password"] = password_hash($this->password, PASSWORD_DEFAULT);
            } else {
                $sql .= ", password = :password";
                $params[":password"] = $this->password;
            }
        }

        if ($this->photo !== null) {
            $sql .= ", photo = :photo";
            $params[":photo"] = $this->photo;
        }

        $sql .= " WHERE id = :id";

        $stmt = Connect::getInstance()->prepare($sql);
        
        foreach ($params as $param => $value) {
            if ($param === ":id" || $param === ":idType") {
                $stmt->bindValue($param, $value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($param, $value, PDO::PARAM_STR);
            }
        }

        $result = $stmt->execute();
        
        if (!$result) {
            $this->errorMessage = "Erro ao executar a atualização";
            error_log("SQL: " . $sql);
            error_log("Params: " . json_encode($params));
            error_log("PDO Error: " . json_encode($stmt->errorInfo()));
        }
        
        return $result;
        
    } catch (PDOException $e) {
        $this->errorMessage = "Erro ao atualizar o registro: {$e->getMessage()}";
        error_log("PDOException em updateById: " . $e->getMessage());
        return false;
    }
}

    private function emailExists(string $email): bool
    {
        try {
            $sql = "SELECT COUNT(*) FROM {$this->table} WHERE email = :email";
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
            
        } catch (PDOException $e) {
            return false;
        }
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
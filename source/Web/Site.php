<?php

namespace Source\Web;

class Site extends Controller
{
    public function __construct()
    {
        parent::__construct("web");
    }
        
    public function home(): void
    {
        echo $this->view->render("home", []);
    }
        
    public function about(): void
    {
        echo $this->view->render("about", []);
    }
        
    public function login(): void
    {
        echo $this->view->render("login", []);
    }
        
    public function register(array $data = []): void
    {
        echo $this->view->render("register", []);
    }
        
    public function profile(): void
    {
        echo $this->view->render("profile", []);
    }

    public function edit(): void
{
    echo $this->view->render("edit", []);
}

    // MÉTODOS PARA RECEITAS
    public function receitaCapuccino(): void
    {
        echo $this->view->render("receita-capuccino", [
            "title" => "Receita de Cappuccino - TastyTales"
        ]);
    }

    public function receitaBrigadeiro(): void
    {
        echo $this->view->render("receita-brigadeiro", [
            "title" => "Receita de Brigadeiro - TastyTales"
        ]);
    }

    public function receitaBolo(): void
    {
        echo $this->view->render("receita-bolo", [
            "title" => "Receita de Bolo de Cenoura - TastyTales"
        ]);
    }

    public function receitaLasanha(): void
    {
        echo $this->view->render("receita-lasanha", [
            "title" => "Receita de Lasanha - TastyTales"
        ]);
    }
        
    public function logOut(): void
    {
        echo $this->view->render("logout", [
            "title" => "Logout - TastyTales"
        ]);
    }
        
    public function error(array $data): void
    {
        $errorCode = $data["errcode"] ?? "404";
        echo $this->view->render("error", [
            "title" => "Erro {$errorCode} - TastyTales",
            "errorCode" => $errorCode
        ]);
    }

public function registerPost(array $data): void
{
    // Validação dos campos obrigatórios
    if (empty($data["name"]) || empty($data["email"]) || empty($data["password"])) {
        // Redireciona de volta com erro
        header("Location: " . url("/cadastro?error=Todos os campos são obrigatórios"));
        exit;
    }

    // Validação de email
    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        header("Location: " . url("/cadastro?error=E-mail inválido"));
        exit;
    }

    // Validação de senha
    if (strlen($data["password"]) < 6) {
        header("Location: " . url("/cadastro?error=Senha deve ter pelo menos 6 caracteres"));
        exit;
    }

    // Criar usuário
    $user = new \Source\Models\User(
        null,
        2, // Tipo 2 = Usuário comum
        $data["name"],
        $data["email"],
        $data["password"]
    );

    if ($user->insert()) {
        // Sucesso - redireciona para login
        header("Location: " . url("/login?success=Usuário cadastrado com sucesso!"));
        exit;
    } else {
        // Erro - volta para cadastro
        header("Location: " . url("/cadastro?error=" . urlencode($user->getErrorMessage())));
        exit;
    }
}
}
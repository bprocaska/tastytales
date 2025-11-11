<?php

namespace Source\Web;

class App extends Controller
{
    public function __construct()
    {
        parent::__construct("app");
    }

    public function home(): void
    {
        echo $this->view->render("home", []);
    }

    public function sugestoes(): void
    {
        echo $this->view->render("sugestoes", []);
    }

    public function about(): void
    {
        echo $this->view->render("about", []);
    }

    public function premium(): void
    {
        echo $this->view->render("premium", []);
    }

    public function profile(): void
    {
        echo $this->view->render("profile", []);
    }

    public function edit(): void
{
    echo $this->view->render("edit", [
        "title" => "Editar Perfil"
    ]);
}

    public function logOut(): void
    {
        // aqui você pode limpar sessão etc
        session_destroy();
        header("Location: " . url("/login"));
        exit;
    }

    public function error(array $data): void
    {
        echo "Error {$data["errcode"]}...";
    }
}

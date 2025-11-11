<?php

namespace Source\Web;

class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct("admin");
    }

    public function home(): void
    {
        //echo "Home Page...";
        echo $this->view->render("admin",[]);
    }

    public function admsugest () : void 
    {
        echo $this->view->render("admsugest",[]);
    }

    public function admin(): void
    {
        echo $this->view->render("admin",[]);
    }

    public function contact(): void
    {
        echo "Contact Us";
    }

    public function location(): void
    {
        echo "Our Location";
    }

    public function cart(): void
    {
        echo "Shopping Cart";
    }

    public function services(): void
    {
        echo "Our Services";
    }

    public function faqs(): void
    {
        echo $this->view->render("faqs",[]);
    }

    public function login(): void
    {
        echo $this->view->render("login",[]);
    }

    public function error (array $data): void
    {
        echo "Error {$data["errcode"]}...";
    }

    public function register (array$data): void
    {
        echo $this->view->render("register");
    }

    public function profile (array $data): void
    {
        echo "Página de Perfil";
    }
}
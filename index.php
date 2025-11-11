<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();
session_start();

// Ajuste a base URL conforme seu ambiente (exemplo: http://localhost/tastytales)
$route = new Router("http://localhost/tastytales");

// Rota de erro DEVE vir ANTES do dispatch
$route->get("/ops/{errcode}", "Site:error");

// Namespace da API
$route->namespace("Source\WebService");
$route->group("/api");

// Rotas API de usuários
$route->get("/users", "Users:listUsers");
$route->post("/users/create", "Users:createUser");
$route->post("/users/login", "Users:login"); 
$route->get("/users/{id}", "Users:listUserById");
$route->post("/users/update", "Users:updateUser");
$route->delete("/users/delete", "Users:deleteUser");
$route->post("/users/logout", "Users:logout");

$route->post("/photo", "Users:updatePhoto");
$route->post("/file", "Users:updateFile");

$route->get("/test", function() {
    echo "GET FUNCIONOU";
    exit();
});

$route->group(null); // volta ao namespace global

// Namespace para as rotas web
$route->namespace("Source\Web");

// Rotas públicas
$route->group(null);

$route->get("/", "Site:home");
$route->get("/sobre", "Site:about");
$route->get("/login", "Site:login");
$route->get("/cadastro", "Site:register");
$route->post("/cadastro", "Site:registerPost");
$route->get("/perfil", "Site:profile");

// Grupo receitas
$route->group("/receita");

$route->get("/capuccino", "Site:receitaCapuccino");
$route->get("/brigadeiro", "Site:receitaBrigadeiro");
$route->get("/bolo", "Site:receitaBolo");
$route->get("/lasanha", "Site:receitaLasanha");

// Fecha grupo receita
$route->group(null);

// Rotas área restrita
$route->group("/app");
$route->get("/", "App:home");
$route->get("/sobrenos", "App:about");
$route->get("/faqs", "App:faqs");
$route->get("/sugestoes", "App:sugestoes");
$route->get("/profile", "App:profile");
$route->get("/assinatura", "App:premium");
$route->get("/editar", "App:edit");
$route->group(null);

// Rotas admin
$route->group("/admin");
$route->get("/", "Admin:home");
$route->get("/sugestoes", "Admin:admsugest");
$route->group(null);

// Dispatch das rotas
$route->dispatch();

// Tratamento de erro
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();

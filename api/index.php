<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use CoffeeCode\Router\Router;

$route = new Router("http://localhost/tastytales/api", ":");

$route->namespace("Source\WebService");

// CORRIGIDO: Rotas de usuários com estrutura consistente
$route->group("/users");

$route->post("/login", "Users:login");                 // POST /api/users/login
$route->get("/", "Users:listUsers");                   // GET /api/users/
$route->get("/id/{id}", "Users:listUserById");         // GET /api/users/id/123
$route->post("/add", "Users:createUser");              // POST /api/users/add
$route->put("/update", "Users:updateUser");            // PUT /api/users/update
$route->delete("/delete/id/{id}", "Users:deleteUser"); // DELETE /api/users/delete/id/123
$route->post("/photo", "Users:updatePhoto"); // POST /api/users/photo


$route->group(null);

// Rotas de categorias
$route->group("/categories");

$route->get("/", "Categories:listCategories");                    // GET /api/categories/
$route->get("/id/{id}", "Categories:listCategoryById");           // GET /api/categories/id/123
$route->post("/add", "Categories:createCategory");                // POST /api/categories/add
$route->put("/update", "Categories:updateCategory");              // PUT /api/categories/update
$route->delete("/delete/id/{id}", "Categories:deleteCategory");   // DELETE /api/categories/delete/id/123

$route->group(null);

// Rotas de receitas
$route->group("/recipes");

$route->get("/", "Recipes:listRecipes");                    // GET /api/recipes/
$route->get("/id/{id}", "Recipes:listRecipeById");          // GET /api/recipes/id/123
$route->post("/add", "Recipes:createRecipe");               // POST /api/recipes/add
$route->put("/update", "Recipes:updateRecipe");             // PUT /api/recipes/update
$route->delete("/delete/id/{id}", "Recipes:deleteRecipe");  // DELETE /api/recipes/delete/id/123

$route->group(null);

// Tratamento de erros
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    
    $errorCode = $route->error();
    $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'unknown';
    $requestUri = $_SERVER['REQUEST_URI'] ?? 'unknown';
    
    // Log para debug (remover em produção)
    error_log("API Error - Code: {$errorCode}, Method: {$requestMethod}, URI: {$requestUri}");
    
    switch ($errorCode) {
        case 403:
            http_response_code(403);
            echo json_encode([
                "code" => 403,
                "status" => "forbidden",
                "message" => "Acesso negado. Método não permitido ou rota protegida.",
                "method" => $requestMethod,
                "requested_url" => $requestUri,
                "debug_info" => [
                    "available_methods" => "POST para /users/login",
                    "check" => "Verifique se está enviando POST e não GET"
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;
            
        case 404:
        default:
            http_response_code(404);
            echo json_encode([
                "code" => 404,
                "status" => "not_found", 
                "message" => "URL não encontrada",
                "method" => $requestMethod,
                "requested_url" => $requestUri,
                "debug_info" => [
                    "available_endpoints" => [
                        "/api/users/login (POST)",
                        "/api/users/ (GET)",
                        "/api/categories/ (GET)",
                        "/api/recipes/ (GET)"
                    ]
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;
    }
    exit();
}

$route->dispatch();

ob_end_flush();
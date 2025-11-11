<?php

namespace Source\WebService;

use Source\Models\Recipes;
use Source\Core\JWTToken;

class RecipesService extends Api
{
    public function listRecipes(): void
    {
        $recipes = new Recipes();
        $this->call(200, "success", "Lista de receitas", "success")
            ->back($recipes->findAll());
    }

    public function createRecipe(array $data): void
    {
        $this->auth(); // Requer autenticação

        if (in_array("", $data)) {
            $this->call(400, "bad_request", "Dados inválidos", "error")->back();
            return;
        }

        $recipe = new Recipes(
            null,
            $data["idCategory"] ?? null,
            $data["name"] ?? null,
            $data["preparationMethod"] ?? null,
            $data["preparationTime"] ?? null,
            $data["image"] ?? null,
            date("Y-m-d H:i:s"),
            null,
            null
        );

        if (!$recipe->insert()) {
            $this->call(500, "internal_server_error", $recipe->getErrorMessage(), "error")->back();
            return;
        }

        $this->call(201, "created", "Receita criada com sucesso", "success")
            ->back([
                "name" => $recipe->getName(),
                "category" => $recipe->getIdCategory(),
                "preparationTime" => $recipe->getPreparationTime()
            ]);
    }

    public function listRecipeById(array $data): void
    {
        if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $recipe = new Recipes();

        if (!$recipe->findById($data["id"])) {
            $this->call(404, "not_found", "Receita não encontrada", "error")->back();
            return;
        }

        $this->call(200, "success", "Receita encontrada", "success")->back([
            "name" => $recipe->getName(),
            "preparationMethod" => $recipe->getPreparationMethod(),
            "preparationTime" => $recipe->getPreparationTime(),
            "image" => $recipe->getImage()
        ]);
    }

    public function deleteRecipe(array $data): void
    {
        $this->auth();

        if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $recipe = new Recipes();

        if (!$recipe->findById($data["id"])) {
            $this->call(404, "not_found", "Receita não encontrada", "error")->back();
            return;
        }

        if (!$recipe->delete()) {
            $this->call(500, "internal_server_error", "Erro ao deletar receita", "error")->back();
            return;
        }

        $this->call(200, "success", "Receita excluída com sucesso", "success")->back();
    }
}

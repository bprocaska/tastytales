<?php

namespace Source\WebService;

use Source\Models\Category;

class Categories extends Api
{
    public function listCategories(): void
    {
        $category = new Categories();
        $this->call(200, "success", "Lista de categorias", "success")
            ->back($category->findAll());
    }

    public function createCategory(array $data): void
    {
        $this->auth(); 

        if (empty($data["name"])) {
            $this->call(400, "bad_request", "Nome da categoria é obrigatório", "error")->back();
            return;
        }

        $category = new Categories(null, $data["name"]);

        if (!$category->insert()) {
            $this->call(500, "internal_server_error", $category->getErrorMessage(), "error")->back();
            return;
        }

        $this->call(201, "created", "Categoria criada com sucesso", "success")
            ->back([
                "id" => $category->getId(),
                "name" => $category->getName()
            ]);
    }

    public function listCategoryById(array $data): void
    {
        if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $category = new Categories();

        if (!$category->findById($data["id"])) {
            $this->call(404, "not_found", "Categoria não encontrada", "error")->back();
            return;
        }

        $this->call(200, "success", "Categoria encontrada", "success")
            ->back([
                "id" => $category->getId(),
                "name" => $category->getName()
            ]);
    }

    public function deleteCategory(array $data): void
    {
        $this->auth();

        if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $category = new Categories();

        if (!$category->findById($data["id"])) {
            $this->call(404, "not_found", "Categoria não encontrada", "error")->back();
            return;
        }

        if (!$category->delete()) {
            $this->call(500, "internal_server_error", "Erro ao excluir categoria", "error")->back();
            return;
        }

        $this->call(200, "success", "Categoria excluída com sucesso", "success")->back();
    }
}

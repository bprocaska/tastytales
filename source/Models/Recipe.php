<?php

namespace Source\Models;

use Source\Core\Connect;
use Source\Core\Model;
use PDO;
use PDOException;

class Recipe extends Model
{
    protected $id;
    protected $idCategory;
    protected $name;
    protected $preparationMethod;
    protected $preparationTime;
    protected $image;
    protected $createdAt;
    protected $updatedAt;
    protected $deletedAt;
    

    public function __construct(
        int $id = null,
        int $idCategory = null,
        string $name = null,
        string $preparationMethod = null,
        int $preparationTime = null,
        string $image = null,
        string $createdAt = null,
        string $updatedAt = null,
        string $deletedAt = null
    )
    {
        $this->table = "recipes";
        $this->id = $id;
        $this->idCategory = $idCategory;
        $this->name = $name;
        $this->preparationMethod = $preparationMethod;
        $this->preparationTime = $preparationTime;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }

    public function setIdCategory(?int $idCategory): void
    {
        $this->idCategory = $idCategory;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

   public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(?int $preparationTime): void
    {
        $this->preparationTime = $preparationTime;
    }

    public function getPreparationMethod(): ?string
    {
        return $this->preparationMethod;
    }

    public function setPreparationMethod(?string $preparationMethod): void
    {
        $this->preparationMethod = $preparationMethod;
    }

        public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?string $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

}
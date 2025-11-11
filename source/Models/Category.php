<?php

namespace Source\Models;

use Source\Core\Model;

class Category extends Model
{
    protected $id;
    protected $name;

    public function __construct(int $id = null, string $name = null)
    {
        $this->table = "categories";
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

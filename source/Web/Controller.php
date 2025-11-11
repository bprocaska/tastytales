<?php

namespace Source\Web;

use League\Plates\Engine;

class Controller
{
    protected $view;

    public function __construct(string $pathToView)
    {
        $this->view = new Engine(__DIR__ . "/../../views/{$pathToView}", "php");
        
        // Adiciona a função url globalmente para as views
        $this->view->registerFunction('url', function($path = '') {
            return "http://localhost/tastytales" . ($path ? "/" . ltrim($path, "/") : "");
        });
    }
}
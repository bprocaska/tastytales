<?php

/**
 * Funções comuns de ajuda para o sistema.
 */

function url(string $path = null): string
{
    $base = rtrim(CONF_URL_BASE, "/");
    $path = $path ? "/".ltrim($path, "/") : "";
    return $base . $path;
}
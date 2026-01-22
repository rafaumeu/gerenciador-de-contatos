<?php

declare(strict_types=1);

namespace Core;

abstract class Controller
{
    /**
     * @param  string  $viewPath  Nome do arquivo (ex: 'home' ou 'contatos/index')
     * @param  array  $data  o array de dados (ex: ['titulo' => 'Contatos'])
     */
    protected function view(string $viewPath, array $data = [], string $layoutPath = 'template/app'): void
    {
        View::render($viewPath, $data, $layoutPath);
    }
}

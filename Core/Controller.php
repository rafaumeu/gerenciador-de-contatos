<?php

declare(strict_types=1);

namespace Core;

abstract class Controller
{
    /**
     * @param  string  $viewPath  Nome do arquivo (ex: 'home' ou 'contatos/index')
     * @param  array  $data  o arrau de dados (ex: ['titulo' => 'Contatos'])
     */
    protected function view(string $viewPath, array $data = []): void
    {
        extract($data);
        $filename = __DIR__."/../views/{$viewPath}.view.php";

        if (file_exists($filename)) {
            require $filename;
        } else {
            http_response_code(404);
            echo "Erro: View '{$viewPath}' não encontrada.";
        }
    }
}

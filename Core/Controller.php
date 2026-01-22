<?php

declare(strict_types=1);

namespace Core;

abstract class Controller
{
    /**
     * @param  string  $viewPath  Nome do arquivo (ex: 'home' ou 'contatos/index')
     * @param  array  $data  o arrau de dados (ex: ['titulo' => 'Contatos'])
     */
    protected function view(string $viewPath, array $data = [], string $layoutPath = 'template/app'): void
    {
        extract($data);
        $viewFile = __DIR__."/../views/{$viewPath}.view.php";
        $layoutFile = __DIR__."/../views/{$layoutPath}.php";

        if (! file_exists($layoutFile)) {
            http_response_code(404);
            echo "Erro: Layout '{$layoutPath}' não encontrado.";

            return;
        }
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;

    }
}

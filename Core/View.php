<?php

declare(strict_types=1);

namespace Core;

class View
{
    public static function render(string $viewPath, array $data = [], string $layoutPath = 'template/app'): void
    {
        extract($data);
        $viewFile = __DIR__."/../views/{$viewPath}.view.php";
        $layoutFile = __DIR__."/../views/{$layoutPath}.php";

        if (! file_exists($viewFile)) {
            http_response_code(404);
            echo "Erro: View '{$viewPath}' não encontrada.";

            return;
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }
}

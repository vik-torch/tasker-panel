<?php

namespace Core\View;

class View implements IView
{
    protected const VIEW_PATH = 'resources/views/';

    public function render(string $view, $data = []): string|null
    {
        extract($data);
        ob_start();
        static::includeView($view);
        return ob_get_clean() ?? null;
    }

    private static function includeView($view)
    {
        $file_path = static::VIEW_PATH . $view . '.php';
        if (file_exists($file_path)) {
            include $file_path;
        }
    }
}
<?php

namespace Core\View;

interface IView
{
    public function render(string $view, $data = []): string|null;
}
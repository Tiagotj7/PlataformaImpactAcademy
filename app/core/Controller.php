<?php
class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/' . $template . '.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}

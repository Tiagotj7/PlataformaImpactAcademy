<?php
function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? $default;
}

function dd(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    exit;
}

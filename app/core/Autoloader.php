<?php
class Autoloader
{
    public function register(): void
    {
        spl_autoload_register([$this, 'autoload']);
    }

    public function autoload(string $class): void
    {
        $prefixes = [
            'App\\' => __DIR__ . '/..',
            '' => __DIR__ . '/..',
        ];

        foreach ($prefixes as $prefix => $baseDir) {
            if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
                continue;
            }

            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . '/' . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
}

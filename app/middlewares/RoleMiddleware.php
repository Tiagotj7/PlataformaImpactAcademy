<?php
class RoleMiddleware
{
    public static function handle(string $role): void
    {
        if (!Auth::check() || (Auth::user()['role'] ?? '') !== $role) {
            header('Location: /');
            exit;
        }
    }
}

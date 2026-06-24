<?php
class AuthMiddleware
{
    public static function handle(): void
    {
        if (!Auth::check()) {
            header('Location: /auth/login');
            exit;
        }
    }
}

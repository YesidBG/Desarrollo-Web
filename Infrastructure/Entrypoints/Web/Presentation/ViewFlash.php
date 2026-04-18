<?php

namespace Infrastructure\Entrypoints\Web\Presentation;

class View
{
    private static $basePath = '';

    public static function setBasePath(string $path): void
    {
        self::$basePath = rtrim($path, '/\\');
    }

    public static function render(string $template, array $data = []): void
{
    $file = self::$basePath
          . DIRECTORY_SEPARATOR . 'Infrastructure'
          . DIRECTORY_SEPARATOR . 'Entrypoints'
          . DIRECTORY_SEPARATOR . 'Web'
          . DIRECTORY_SEPARATOR . 'Presentation'
          . DIRECTORY_SEPARATOR . 'Views'
          . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $template)
          . '.php';

    if (!file_exists($file)) {
        throw new \RuntimeException("Vista no encontrada: " . $file);
    }

    extract($data, EXTR_SKIP);
    require $file;
}

    public static function redirect(string $route, array $params = []): void
    {
        // Construir URL absoluta con el puerto correcto
        $host   = $_SERVER['HTTP_HOST'];                    // localhost:8080
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']); // /crud-docentes/public/index.php
        $base   = dirname($script);                         // /crud-docentes/public
        $query  = http_build_query(array_merge(['route' => $route], $params));
        $url    = 'http://' . $host . $base . '/index.php?' . $query;

        header('Location: ' . $url);
        exit;
    }
}

class Flash
{
    public static function set(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'][$type] = $message;
    }

    public static function get(string $type): ?string
    {
        $msg = $_SESSION['flash'][$type] ?? null;
        unset($_SESSION['flash'][$type]);
        return $msg;
    }

    public static function has(string $type): bool
    {
        return isset($_SESSION['flash'][$type]);
    }
}
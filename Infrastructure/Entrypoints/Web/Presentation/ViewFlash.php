<?php

namespace Infrastructure\Entrypoints\Web\Presentation;

/**
 * Motor de plantillas mínimo.
 *
 * View::render('docentes/list', ['docentes' => $arr])
 *   → hace extract($data) y require el archivo de vista correspondiente.
 *
 * View::redirect('docentes.index')
 *   → envía header Location y termina la ejecución (patrón PRG).
 */
class View
{
    private static string $basePath = '';

    public static function setBasePath(string $path): void
    {
        self::$basePath = rtrim($path, '/');
    }

    public static function render(string $template, array $data = []): void
    {
        $file = self::$basePath . '/Infrastructure/Entrypoints/Web/Presentation/Views/' . $template . '.php';
        if (!file_exists($file)) {
            throw new \RuntimeException("Vista no encontrada: $template");
        }
        extract($data, EXTR_SKIP);
        require $file;
    }

    public static function redirect(string $route, array $params = []): void
    {
        $base  = dirname($_SERVER['SCRIPT_NAME']);
        $base  = rtrim($base, '/');
        $query = http_build_query(array_merge(['route' => $route], $params));
        header("Location: $base/index.php?$query");
        exit;
    }
}

// ─────────────────────────────────────────────────────────────────────────────

/**
 * Mensajes flash de sesión.
 *
 * Flash::set('success', 'Operación exitosa')  → guarda en $_SESSION
 * Flash::get('success')                        → lee y borra de $_SESSION
 */
class Flash
{
    public static function set(string $type, string $message): void
    {
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

<?php

namespace Infrastructure\Entrypoints\Web\Controllers\Config;

/**
 * Tabla de rutas del sistema.
 *
 * Formato: 'nombre.ruta' => ['method' => 'GET|POST', 'action' => 'metodo del controlador']
 *
 * index.php lee $_GET['route'], busca aquí, valida el método HTTP
 * y despacha al DocenteController.
 */
class WebRoutes
{
    private static array $routes = [
        // ── Docentes CRUD ─────────────────────────────────────────
        'docentes.index'   => ['method' => 'GET',  'action' => 'index'],
        'docentes.create'  => ['method' => 'GET',  'action' => 'create'],
        'docentes.store'   => ['method' => 'POST', 'action' => 'store'],
        'docentes.show'    => ['method' => 'GET',  'action' => 'show'],
        'docentes.edit'    => ['method' => 'GET',  'action' => 'edit'],
        'docentes.update'  => ['method' => 'POST', 'action' => 'update'],
        'docentes.destroy' => ['method' => 'POST', 'action' => 'destroy'],
        // ── Home ──────────────────────────────────────────────────
        'home'             => ['method' => 'GET',  'action' => 'home'],
    ];

    public static function all(): array
    {
        return self::$routes;
    }

    public static function find(string $name): ?array
    {
        return self::$routes[$name] ?? null;
    }
}

<?php

namespace Infrastructure\Entrypoints\Web\Controllers\Config;

class WebRoutes
{
    private static $routes = array(
        // ── Auth ──────────────────────────────────────────────────
        'auth.login'         => array('method' => 'GET',  'action' => 'showLogin',      'ctrl' => 'auth'),
        'auth.authenticate'  => array('method' => 'POST', 'action' => 'authenticate',   'ctrl' => 'auth'),
        'auth.logout'        => array('method' => 'GET',  'action' => 'logout',         'ctrl' => 'auth'),
        'auth.forgot'        => array('method' => 'GET',  'action' => 'showForgot',     'ctrl' => 'auth'),
        'auth.processForgot' => array('method' => 'POST', 'action' => 'processForgot',  'ctrl' => 'auth'),
        // ── Docentes ──────────────────────────────────────────────
        'docentes.index'     => array('method' => 'GET',  'action' => 'index',   'ctrl' => 'docente'),
        'docentes.create'    => array('method' => 'GET',  'action' => 'create',  'ctrl' => 'docente'),
        'docentes.store'     => array('method' => 'POST', 'action' => 'store',   'ctrl' => 'docente'),
        'docentes.show'      => array('method' => 'GET',  'action' => 'show',    'ctrl' => 'docente'),
        'docentes.edit'      => array('method' => 'GET',  'action' => 'edit',    'ctrl' => 'docente'),
        'docentes.update'    => array('method' => 'POST', 'action' => 'update',  'ctrl' => 'docente'),
        'docentes.destroy'   => array('method' => 'POST', 'action' => 'destroy', 'ctrl' => 'docente'),
        // ── Home ──────────────────────────────────────────────────
        'home'               => array('method' => 'GET',  'action' => 'home',    'ctrl' => 'docente'),
    );

    public static function all(): array  { return self::$routes; }
    public static function find(string $name): ?array { return self::$routes[$name] ?? null; }

    public static function isPublic(string $name): bool
    {
        $publicas = array('auth.login', 'auth.authenticate', 'auth.forgot', 'auth.processForgot');
        return in_array($name, $publicas, true);
    }
}
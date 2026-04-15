<?php

declare(strict_types=1);

// ─────────────────────────────────────────────────────────────────────────────
// 0. Configuración base
// ─────────────────────────────────────────────────────────────────────────────
session_start();

define('ROOT', dirname(__DIR__));   // raíz del proyecto

// ── Autoloader manual (sin Composer para mantener el proyecto simple) ─────────
spl_autoload_register(function (string $class): void {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// ── Configuración del motor de vistas ─────────────────────────────────────────
use Infrastructure\Entrypoints\Web\Presentation\View;
use Infrastructure\Entrypoints\Web\Presentation\Flash;
View::setBasePath(ROOT);

// ─────────────────────────────────────────────────────────────────────────────
// 1. Configuración de base de datos
//    Ajusta host, dbname, user y password según tu entorno local.
// ─────────────────────────────────────────────────────────────────────────────
$dbConfig = [
    'host'     => 'localhost',
    'dbname'   => 'crud_docentes',
    'user'     => 'root',
    'password' => '',          // ← cambia si tienes contraseña en MySQL
    'charset'  => 'utf8mb4',
];

try {
    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
    $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die('<div style="font-family:monospace;color:red;padding:1rem;">
         <b>Error de conexión a la base de datos:</b><br>'
        . htmlspecialchars($e->getMessage())
        . '<br><br>Verifica que MySQL esté corriendo y que la base de datos
           <b>crud_docentes</b> exista (ejecuta <code>database.sql</code>).
         </div>');
}

// ─────────────────────────────────────────────────────────────────────────────
// 2. Construcción del grafo de dependencias (DI manual)
// ─────────────────────────────────────────────────────────────────────────────
use Infrastructure\Persistence\Mappers\DocentePersistenceMapper;
use Infrastructure\Persistence\MySQL\DocenteRepositoryMySQL;
use Application\Services\CreateDocenteService;
use Application\Services\UpdateDocenteService;
use Application\Services\DeleteDocenteService;
use Application\Services\GetDocenteByIdService;
use Application\Services\GetAllDocentesService;
use Infrastructure\Entrypoints\Web\Controllers\Mapper\DocenteWebMapper;
use Infrastructure\Entrypoints\Web\Controllers\DocenteController;
use Infrastructure\Entrypoints\Web\Controllers\Config\WebRoutes;

// Infraestructura
$persistMapper = new DocentePersistenceMapper();
$repository    = new DocenteRepositoryMySQL($pdo, $persistMapper);

// Servicios de aplicación  (inyectamos los puertos = el repositorio)
$createSvc   = new CreateDocenteService($repository, $repository);
$updateSvc   = new UpdateDocenteService($repository, $repository, $repository);
$deleteSvc   = new DeleteDocenteService($repository, $repository);
$getByIdSvc  = new GetDocenteByIdService($repository);
$getAllSvc    = new GetAllDocentesService($repository);

// Controlador
$webMapper  = new DocenteWebMapper();
$controller = new DocenteController(
    $createSvc, $updateSvc, $deleteSvc,
    $getByIdSvc, $getAllSvc,
    $webMapper
);

// ─────────────────────────────────────────────────────────────────────────────
// 3. Enrutamiento
// ─────────────────────────────────────────────────────────────────────────────
$routeName = $_GET['route'] ?? 'home';
$route     = WebRoutes::find($routeName);

if ($route === null) {
    Flash::set('error', "Ruta '$routeName' no encontrada.");
    View::redirect('home');
}

// Validar método HTTP
$method = $_SERVER['REQUEST_METHOD'];
if (strtoupper($method) !== strtoupper($route['method'])) {
    http_response_code(405);
    die("Método HTTP no permitido para esta ruta.");
}

// ─────────────────────────────────────────────────────────────────────────────
// 4. Despacho al controlador + manejo global de excepciones
// ─────────────────────────────────────────────────────────────────────────────
try {
    $action = $route['action'];
    $controller->$action();
} catch (\Throwable $e) {
    Flash::set('error', 'Error inesperado: ' . $e->getMessage());
    View::redirect('home');
}

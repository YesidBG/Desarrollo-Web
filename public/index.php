<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

define('ROOT', dirname(__DIR__));

function loadClass(string ...$parts): void {
    require_once ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
}

loadClass('Domain', 'Exceptions', 'DocenteExceptions');
loadClass('Domain', 'Enums', 'EscalafonDocente');
loadClass('Domain', 'Enums', 'IdiomaDocente');
loadClass('Domain', 'ValueObjects', 'DocenteId');
loadClass('Domain', 'ValueObjects', 'DocenteNombre');
loadClass('Domain', 'ValueObjects', 'DocenteEmail');
loadClass('Domain', 'ValueObjects', 'DocenteTelefono');
loadClass('Domain', 'ValueObjects', 'DocenteBlog');
loadClass('Domain', 'ValueObjects', 'DocenteAniosExperiencia');
loadClass('Domain', 'ValueObjects', 'DocentePassword');
loadClass('Domain', 'Models', 'DocenteModel');
loadClass('Application', 'Ports', 'Out', 'DocentePorts');
loadClass('Application', 'Ports', 'In', 'DocenteUseCases');
loadClass('Application', 'Commands', 'DocenteCommands');
loadClass('Application', 'Queries', 'DocenteQueries');
loadClass('Application', 'Services', 'DocenteServices');
loadClass('Infrastructure', 'Persistence', 'Mappers', 'DocentePersistenceMapper');
loadClass('Infrastructure', 'Persistence', 'MySQL', 'DocenteRepositoryMySQL');
loadClass('Infrastructure', 'Entrypoints', 'Web', 'Presentation', 'ViewFlash');
loadClass('Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'Config', 'WebRoutes');
loadClass('Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'Dto', 'DocenteWebDtos');
loadClass('Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'Mapper', 'DocenteWebMapper');
loadClass('Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'DocenteController');
loadClass('Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'AuthController');

use Infrastructure\Entrypoints\Web\Presentation\View;
use Infrastructure\Entrypoints\Web\Presentation\Flash;
use Infrastructure\Persistence\Mappers\DocentePersistenceMapper;
use Infrastructure\Persistence\MySQL\DocenteRepositoryMySQL;
use Application\Services\CreateDocenteService;
use Application\Services\UpdateDocenteService;
use Application\Services\DeleteDocenteService;
use Application\Services\GetDocenteByIdService;
use Application\Services\GetAllDocentesService;
use Application\Services\LoginService;
use Application\Services\ForgotPasswordService;
use Infrastructure\Entrypoints\Web\Controllers\Mapper\DocenteWebMapper;
use Infrastructure\Entrypoints\Web\Controllers\DocenteController;
use Infrastructure\Entrypoints\Web\Controllers\AuthController;
use Infrastructure\Entrypoints\Web\Controllers\Config\WebRoutes;

View::setBasePath(ROOT);

// ── Base de datos ─────────────────────────────────────────────────────────
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=crud_docentes;charset=utf8mb4',
        'root',
        '123456',
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('<div style="font-family:monospace;color:red;padding:2rem;">
         <b>Error BD:</b><br>' . htmlspecialchars($e->getMessage()) . '</div>');
}

// ── Dependencias ──────────────────────────────────────────────────────────
$persistMapper = new DocentePersistenceMapper();
$repository    = new DocenteRepositoryMySQL($pdo, $persistMapper);

$createSvc  = new CreateDocenteService($repository, $repository);
$updateSvc  = new UpdateDocenteService($repository, $repository, $repository);
$deleteSvc  = new DeleteDocenteService($repository, $repository);
$getByIdSvc = new GetDocenteByIdService($repository);
$getAllSvc   = new GetAllDocentesService($repository);
$loginSvc   = new LoginService($repository);
$forgotSvc  = new ForgotPasswordService($repository, $repository);

$webMapper   = new DocenteWebMapper();
$docenteCtrl = new DocenteController($createSvc, $updateSvc, $deleteSvc, $getByIdSvc, $getAllSvc, $webMapper);
$authCtrl    = new AuthController($loginSvc, $forgotSvc);

// ── Enrutamiento ──────────────────────────────────────────────────────────
$routeName = $_GET['route'] ?? 'auth.login';
$route     = WebRoutes::find($routeName);

if ($route === null) {
    Flash::set('error', "Ruta no encontrada.");
    View::redirect('auth.login');
    exit;
}

// ── Protección de sesión ──────────────────────────────────────────────────
if (!WebRoutes::isPublic($routeName) && !isset($_SESSION['auth'])) {
    Flash::set('error', 'Debes iniciar sesión para acceder.');
    View::redirect('auth.login');
    exit;
}

if (strtoupper($_SERVER['REQUEST_METHOD']) !== strtoupper($route['method'])) {
    http_response_code(405);
    die("Método HTTP no permitido.");
}

// ── Despacho ──────────────────────────────────────────────────────────────
try {
    $action = $route['action'];
    $ctrl   = $route['ctrl'];

    if ($ctrl === 'auth') {
        $authCtrl->$action();
    } else {
        $docenteCtrl->$action();
    }
} catch (\Throwable $e) {
    Flash::set('error', 'Error: ' . $e->getMessage());
    View::redirect('auth.login');
}
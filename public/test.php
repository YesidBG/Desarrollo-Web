<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "PHP funciona<br>";

define('ROOT', dirname(__DIR__));
echo "ROOT: " . ROOT . "<br>";

// Cargar de uno en uno y ver cuál falla
$archivos = [
    ['Domain', 'Exceptions', 'DocenteExceptions'],
    ['Domain', 'Enums', 'EscalafonDocente'],
    ['Domain', 'Enums', 'IdiomaDocente'],
    ['Domain', 'ValueObjects', 'DocenteId'],
    ['Domain', 'ValueObjects', 'DocenteNombre'],
    ['Domain', 'ValueObjects', 'DocenteEmail'],
    ['Domain', 'ValueObjects', 'DocenteTelefono'],
    ['Domain', 'ValueObjects', 'DocenteBlog'],
    ['Domain', 'ValueObjects', 'DocenteAniosExperiencia'],
    ['Domain', 'Models', 'DocenteModel'],
    ['Application', 'Ports', 'Out', 'DocentePorts'],
    ['Application', 'Ports', 'In', 'DocenteUseCases'],
    ['Application', 'Commands', 'DocenteCommands'],
    ['Application', 'Queries', 'DocenteQueries'],
    ['Application', 'Services', 'DocenteServices'],
    ['Infrastructure', 'Persistence', 'Mappers', 'DocentePersistenceMapper'],
    ['Infrastructure', 'Persistence', 'MySQL', 'DocenteRepositoryMySQL'],
    ['Infrastructure', 'Entrypoints', 'Web', 'Presentation', 'ViewFlash'],
    ['Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'Config', 'WebRoutes'],
    ['Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'Dto', 'DocenteWebDtos'],
    ['Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'Mapper', 'DocenteWebMapper'],
    ['Infrastructure', 'Entrypoints', 'Web', 'Controllers', 'DocenteController'],
];

foreach ($archivos as $partes) {
    $archivo = ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $partes) . '.php';
    echo "Cargando: " . implode('/', $partes) . " ... ";
    if (!file_exists($archivo)) {
        echo "<b style='color:red'>NO EXISTE</b><br>";
        continue;
    }
    require_once $archivo;
    echo "<b style='color:green'>OK</b><br>";
}

echo "<br><b>Todos los archivos cargados correctamente</b>";
<?php
if (php_sapi_name() === 'cli-server') {
    $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $file = __DIR__ . $uri;
    
    if ($uri !== '/' && file_exists($file)) {
        return false; // Deja que el servidor sirva el archivo
    }
}

require __DIR__ . '/../src/Core/Router.php';
require __DIR__ . '/../src/Core/Controller.php';
require __DIR__ . '/../src/Controllers/ExamController.php';

require_once __DIR__ . '/../src/Models/Persona.php';
require_once __DIR__ . '/../src/Models/Trabajador.php';
require_once __DIR__ . '/../src/Models/Empleado.php';
require_once __DIR__ . '/../src/Models/RepoInterface.php';
require_once __DIR__ . '/../src/Models/UsuarioRepo.php';

$router = new Router();
$controller = new ExamController();

$router->get('/', [$controller, 'index']);
$router->get('/run', [$controller, 'run']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require 'config.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/users' || str_starts_with($uri, '/users/')) {
    require 'routes/users.php';
} elseif ($uri === '/prompts/users' || str_starts_with($uri, '/prompts/users/')) {
    require 'routes/prompts_users.php';
} elseif ($uri === '/prompts/generic') {
    require 'routes/prompts_generic.php';
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
}
?>

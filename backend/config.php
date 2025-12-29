<?php
require 'vendor/autoload.php';

use MongoDB\Client;

$mongoUri = 'mongodb://mongo:27017'; // Cambia 'mongo' si tu container tiene otro nombre
$database = 'youcode';

try {
    $client = new Client($mongoUri);
    $db = $client->$database;
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo conectar a la base de datos', 'message' => $e->getMessage()]);
    exit;
}
?>

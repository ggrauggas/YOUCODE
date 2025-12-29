<?php
$collection = $db->prompts_generic;

switch ($method) {
    case 'GET':
        $prompts = $collection->find()->toArray();
        echo json_encode($prompts);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>

<?php
$collection = $db->users;

switch ($method) {
    case 'GET':
        $users = $collection->find()->toArray();
        echo json_encode($users);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $data['createdAt'] = new MongoDB\BSON\UTCDateTime();
        $collection->insertOne($data);
        echo json_encode(['message' => 'Usuario creado', 'id' => (string)$data['_id']]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>

<?php
$collection = $db->prompts_users;

switch ($method) {
    case 'GET':
        if (isset($_GET['userId'])) {
            $prompts = $collection->find(['userId' => new MongoDB\BSON\ObjectId($_GET['userId'])])->toArray();
            echo json_encode($prompts);
        } else {
            echo json_encode($collection->find()->toArray());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $data['userId'] = new MongoDB\BSON\ObjectId($data['userId']);
        $data['createdAt'] = new MongoDB\BSON\UTCDateTime();
        $data['updatedAt'] = new MongoDB\BSON\UTCDateTime();
        $collection->insertOne($data);
        echo json_encode(['message' => 'Prompt creado', 'id' => (string)$data['_id']]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = new MongoDB\BSON\ObjectId($data['_id']);
        $data['updatedAt'] = new MongoDB\BSON\UTCDateTime();
        unset($data['_id']);
        $collection->updateOne(['_id' => $id], ['$set' => $data]);
        echo json_encode(['message' => 'Prompt actualizado']);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = new MongoDB\BSON\ObjectId($data['_id']);
        $collection->deleteOne(['_id' => $id]);
        echo json_encode(['message' => 'Prompt eliminado']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>

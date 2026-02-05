<?php

require_once "middlewares/JsonMiddleware.php";
require_once "config/database.php";
require_once "controllers/PatientController.php";

JsonMiddleware::handle();

$db = (new Database())->connect();

$request = $_GET['request'] ?? '';//https://localhost/api/patient/5
$parts = explode("/", $request);//patient/5  ["patient","5"]

$resource = $parts[0];//patient
$id = $parts[1] ?? null;

if ($resource === "patients") {
    $controller = new PatientController($db);
    $controller->handle($_SERVER['REQUEST_METHOD'], $id);
} else {
    http_response_code(404);
    echo json_encode(["status"=>false,"message"=>"Invalid API"]);
}

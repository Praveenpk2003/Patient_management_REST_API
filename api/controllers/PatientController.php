<?php

require_once "models/Patient.php";
require_once "helpers/Response.php";

class PatientController {
    private $model;

    public function __construct($db) {
        $this->model = new Patient($db);
    }

    public function handle($method, $id = null) {
        $data = json_decode(file_get_contents("php://input"), true);

        switch ($method) {
            case "GET":
                if ($id) {
                    $patient = $this->model->getPatientById($id);
                    $patient
                        ? Response::json(true, "Patient found", $patient)
                        : Response::json(false, "Not found", [], 404);
                } else {
                    Response::json(true, "All patients", $this->model->getAllPatients());
                }
                break;

            case "POST":
                $this->model->createPatient($data)
                    ? Response::json(true, "Patient created", [], 201)
                    : Response::json(false, "Creation failed", [], 400);
                break;

            case "PUT":
                $this->model->updatePatient($id, $data)
                    ? Response::json(true, "Updated")
                    : Response::json(false, "Update failed", [], 400);
                break;

            case "DELETE":
                $this->model->deletePatient($id)
                    ? Response::json(true, "Deleted")
                    : Response::json(false, "Delete failed", [], 400);
                break;
        }
    }
}

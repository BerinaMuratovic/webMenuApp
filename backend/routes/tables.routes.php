<?php

require_once __DIR__ . '/../services/table.service.php';

Flight::group('/tables', function() {


    Flight::route('GET /', function () {
        try {
            $table_service = new TableService();
            $tables = $table_service->getAllTables();
            Flight::json($tables, 200);
        } catch (Exception $e) {
            error_log("Error fetching tables: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch tables'], 500);
        }
    });



    Flight::route('GET /@table_id', function ($table_id) {
        if($table_id == NULL || $table_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $table_service = new TableService();
        $data = $table_service->getTableById($table_id);

        if (!$data) {
            Flight::halt(404, "Table not found!");
        }

        Flight::json(['data' => $data, 'message' => "successfull"]);
    });


    Flight::route('DELETE /@table_id', function ($table_id) {
        if($table_id == NULL || $table_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $table_service = new TableService();
        $table_service->deleteTableById($table_id);

        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the table"]);
    });


    Flight::route('POST /', function () {
        $payload = Flight::request()->data->getData();
        if($payload['table_number'] == NULL || $payload['capacity'] == NULL || $payload['status'] == NULL) {
            Flight::halt(500, "Required parameters are missing!");
        }
        unset($payload['id']);
        $table_service = new TableService();
        $table = $table_service->addTable($payload);
        Flight::json(['data' => $table, 'message' => "You have successfully added the table"]);
    });




});

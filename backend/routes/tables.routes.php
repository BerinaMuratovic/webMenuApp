<?php

require_once __DIR__ . '/../services/table.service.php';

Flight::group('/tables', function() {

    /**
     * @OA\Get(
     *      path="/tables",
     *      tags={"tables"},
     *      summary="Get all ables",
     *      @OA\Response(
     *           response=200,
     *           description="Get all tables"
     *      )
     * )
     */
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


    /**
     * @OA\GET(
     *      path="/table/all",
     *      tags={"tables"},
     *      summary="Get all tables",
     *      @OA\Response(
     *           response=200,
     *           description="Get all tables"
     *      )
     * )
     */
    Flight::route('GET /@table_id', function ($table_id) {
        if($table_id == NULL || $table_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $table_service = new TableService();
        $data = $table_service->getTableById($table_id);

        Flight::json(['data' => $data, 'message' => "successfull"]);
    });

    /**
     * @OA\DELETE(
     *      path="/table/all",
     *      tags={"tables"},
     *      summary="Get all tables",
     *      @OA\Response(
     *           response=200,
     *           description="Get all tables"
     *      )
     * )
     */
    Flight::route('DELETE /@table_id', function ($table_id) {
        if($table_id == NULL || $table_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $table_service = new TableService();
        $table_service->deleteTableById($table_id);

        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the table"]);
    });

    /**
     * @OA\Post(
     *      path="/tables/add",
     *      tags={"tables"},
     *      summary="Add table",
     *      @OA\Response(
     *           response=200,
     *           description="Logged user"
     *      ),
     *      @OA\RequestBody(
     *          description="table ID",
     *          @OA\JsonContent(
     *             required={"id", "table_number", "capacity","status"},
     *             @OA\Property(property="id", required=true, type="int", example="1"),
     *             @OA\Property(property="table_number", required=true, type="int", example="3"),
     *             @OA\Property(property="capacity", required=true, type="int", example="6"),
     *             @OA\Property(property="status", required=true, type="enum", example="available")
     *           )
     *      ),
     * )
     */
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

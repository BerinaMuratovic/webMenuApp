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

});

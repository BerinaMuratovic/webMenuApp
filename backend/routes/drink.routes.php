<?php

require_once __DIR__ . '/../services/drink.service.php';

Flight::group('/drinks', function() {

    /**
     * @OA\Get(
     *      path="/drinks/all",
     *      tags={"drinks"},
     *      summary="Get all drinks",
     *      @OA\Response(
     *           response=200,
     *           description="Get all drinks"
     *      )
     * )
     */
    Flight::route('GET /', function () {
        try {
            $drink_service = new DrinkService();
            $drinks = $drink_service->getAllDrinks();
            Flight::json($drinks, 200);
        } catch (Exception $e) {
            error_log("Error fetching drinks: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch drinks'], 500);
        }
    });

});
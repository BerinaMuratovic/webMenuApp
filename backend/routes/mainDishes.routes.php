<?php

require_once __DIR__ . '/../services/main-dish.service.php';

Flight::group('/main_dish', function() {

    /**
     * @OA\Get(
     *      path="/main dishes/all",
     *      tags={"main dishes"},
     *      summary="Get all main dishes",
     *      @OA\Response(
     *           response=200,
     *           description="Get all main dishes"
     *      )
     * )
     */
    Flight::route('GET /', function () {
        try {
            $mainDish_service = new MainDishesService();
            $mainDishes = $mainDish_service->getAllMainDishes();
            Flight::json($mainDishes, 200);
        } catch (Exception $e) {
            error_log("Error fetching dishes: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch dishes'], 500);
        }
    });

});

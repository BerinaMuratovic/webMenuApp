<?php

require_once __DIR__ . '/../services/side-dish.service.php';

Flight::group('/side_dish', function() {

    /**
     * @OA\Get(
     *      path="/side dishes/all",
     *      tags={"side dishes"},
     *      summary="Get all side dishes",
     *      @OA\Response(
     *           response=200,
     *           description="Get all side dishes"
     *      )
     * )
     */
    Flight::route('GET /', function () {
        try {
            $sideDish_service = new SideDishService();
            $sideDishes = $sideDish_service->getAllSideDishes();
            Flight::json($sideDishes, 200);
        } catch (Exception $e) {
            error_log("Error fetching dishes: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch dishes'], 500);
        }
    });

});

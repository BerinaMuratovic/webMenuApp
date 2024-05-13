<?php

require_once __DIR__ . '/../services/reservation.service.php';

Flight::group('/reservations', function() {

    /**
     * @OA\Get(
     *      path="/reservation/all",
     *      tags={"reservations"},
     *      summary="Get all reservations",
     *      @OA\Response(
     *           response=200,
     *           description="Get all reservations"
     *      )
     * )
     */
    Flight::route('GET /', function () {
        try {
            $reservation_service = new ReservationService();
            $reservations = $reservation_service->getAllReservations();
            Flight::json($reservations, 200);
        } catch (Exception $e) {
            error_log("Error fetching reservations: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch reservations'], 500);
        }
    });

});

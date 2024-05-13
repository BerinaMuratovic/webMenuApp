<?php

require_once __DIR__ . '/../services/reservation.service.php';
require_once __DIR__ . '/../services/orders.service.php';

Flight::group('/reservations', function() {

    /**
     * @OA\Get(
     *      path="/reservation",
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

    /**
     * @OA\GET(
     *      path="/reservation/all",
     *      tags={"reservations"},
     *      summary="Get all reservations",
     *      @OA\Response(
     *           response=200,
     *           description="Get all reservations"
     *      )
     * )
     */
    Flight::route('GET /@reservation_id', function ($reservation_id) {
        if($reservation_id == NULL || $reservation_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $reservation_service = new ReservationService();
        $reservation_data = $reservation_service->getReservationById($reservation_id);

        if (!$reservation_data) {
            Flight::halt(404, "Reservation not found!");
        }

        $table_id = $reservation_data['table_id'];

        $order_service = new OrdersService();

        $order_data = $order_service->getOrderswByTableId($table_id);

        if (!$order_data) {
            Flight::halt(404, "Order not found!");
        }

        Flight::json(['order_data' => $order_data, '$reservation_data' => $reservation_data, 'message' => " successfull"]);
    });

    /**
     * @OA\Post(
     *      path="/reservations",
     *      tags={"reservations"},
     *      summary="add new reservation",
     *      @OA\Response(
     *           response=200,
     *           description="Add new reservation"
     *      )
     * )
     */
    Flight::route('POST /', function () {
        try {
            $payload = Flight::request()->data->getData();
            if($payload['user_id'] == NULL || $payload['reservation_date'] == NULL || $payload['num_guests'] == NULL
                || $payload['table_id'] == NULL || $payload['order_id'] == NULL) {
                Flight::halt(500, "Required parameters are missing!");
            }
            $reservation_service = new ReservationService();
            $order = $reservation_service->addReservation($payload);
            Flight::json($order, 200);
        } catch (Exception $e) {
            error_log("Error fetching order: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch order'], 500);
        }
    });

    /**
     * @OA\DELETE(
     *      path="/reservation/all",
     *      tags={"reservations"},
     *      summary="Get all reservations",
     *      @OA\Response(
     *           response=200,
     *           description="Get all reservations"
     *      )
     * )
     */
    Flight::route('DELETE /@reservation_id', function ($reservation_id) {
        if($reservation_id == NULL || $reservation_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $reservation_service = new ReservationService();
        $reservation_service->deleteReservationById($reservation_id);


        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the reservation"]);

    });


});

<?php

require_once __DIR__ . '/../services/orders.service.php';

Flight::group('/orders', function() {

    /**
     * @OA\GET(
     *      path="/order/all",
     *      tags={"orders"},
     *      summary="Get all orders",
     *      @OA\Response(
     *           response=200,
     *           description="Get all orders"
     *      )
     * )
     */
    Flight::route('GET /@order_id', function ($order_id) {
        if($order_id == NULL || $order_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $order_service = new OrdersService();
        $data = $order_service->getOrderById($order_id);

        if (!$data) {
            Flight::halt(404, "Table not found!");
        }


        Flight::json(['data' => $data, 'message' => " successfull"]);
    });


    /**
     * @OA\Get(
     *      path="/orders/all",
     *      tags={"orders"},
     *      summary="Get all orders",
     *      @OA\Response(
     *           response=200,
     *           description="Get all orders"
     *      )
     * )
     */
    Flight::route('GET /', function () {
        try {
            $order_service = new OrdersService();
            $order = $order_service->getAllOrders();
            Flight::json($order, 200);
        } catch (Exception $e) {
            error_log("Error fetching order: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch order'], 500);
        }
    });

    /**
     * @OA\Post(
     *      path="/orders",
     *      tags={"orders"},
     *      summary="add new orders",
     *      @OA\Response(
     *           response=200,
     *           description="Get all orders"
     *      )
     * )
     */
    Flight::route('POST /', function () {
        try {
            $payload = Flight::request()->data->getData();
            if($payload['name'] == NULL || $payload['price'] == NULL) {
                Flight::halt(500, "Required parameters are missing!");
            }
            $order_service = new OrdersService();
            $order = $order_service->addOrder($payload);
            Flight::json($order, 200);
        } catch (Exception $e) {
            error_log("Error fetching order: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch order'], 500);
        }
    });

    /**
     * @OA\DELETE(
     *      path="/order/all",
     *      tags={"orders"},
     *      summary="Get all orders",
     *      @OA\Response(
     *           response=200,
     *           description="Get all orders"
     *      )
     * )
     */
    Flight::route('DELETE /@order_id', function ($order_id) {
        if($order_id == NULL || $order_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $order_service = new OrdersService();
        $data = $order_service->deleteOrderById($order_id);

        if (!$data) {
            Flight::halt(404, "Table not found!");
        }


        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the order"]);
    });

});

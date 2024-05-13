<?php

require_once __DIR__ . '/../services/user.service.php';

Flight::group('/users', function() {

    /**
     * @OA\Get(
     *      path="/user/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Get all users"
     *      )
     * )
     */
    Flight::route('GET /', function () {
        try {
            $user_service = new UserService();
            $users = $user_service->getAllUsers();
            Flight::json($users, 200);
        } catch (Exception $e) {
            error_log("Error fetching users: " . $e->getMessage());
            Flight::json(['error' => 'Failed to fetch users'], 500);
        }
    });

});
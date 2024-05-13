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

    /**
     * @OA\GET(
     *      path="/user/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Get all users"
     *      )
     * )
     */
    Flight::route('GET /@user_id', function ($user_id) {
        if($user_id == NULL || $user_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $user_service = new UserService();
        $data = $user_service->getUserById($user_id);

        Flight::json(['data' => $data, 'message' => "successfull"]);
    });

    /**
     * @OA\DELETE(
     *      path="/user/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Get all users"
     *      )
     * )
     */
    Flight::route('DELETE /@user_id', function ($user_id) {
        if($user_id == NULL || $user_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $user_service = new UserService();
        $user_service->deleteUserById($user_id);

        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the user"]);
    });

    /**
     * @OA\Post(
     *      path="/users/add",
     *      tags={"users"},
     *      summary="Add user",
     *      @OA\Response(
     *           response=200,
     *           description="Logged user"
     *      ),
     *      @OA\RequestBody(
     *          description="table ID",
     *          @OA\JsonContent(
     *             required={"id", "username", "email","password"},
     *             @OA\Property(property="id", required=true, type="int", example="1"),
     *             @OA\Property(property="username", required=true, type="string", example="berina"),
     *             @OA\Property(property="email", required=true, type="string", example="berina@gmail.com"),
     *             @OA\Property(property="password", required=true, type="string", example="strong")
     *           )
     *      ),
     * )
     */
    Flight::route('POST /', function () {
        $payload = Flight::request()->data->getData();
        if($payload['username'] == NULL || $payload['email'] == NULL || $payload['password'] == NULL) {
            Flight::halt(500, "Required parameters are missing!");
        }
        unset($payload['id']);
        $user_service = new UserService();
        $user = $user_service->addUser($payload);
        Flight::json(['data' => $user, 'message' => "You have successfully added the user"]);
    });






});
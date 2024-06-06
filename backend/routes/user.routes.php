<?php

require_once __DIR__ . '/../services/user.service.php';

Flight::group('/users', function() {


    Flight::route('GET /', function () {
        $body = Flight::request()->query;
        $params = [
            "start" => (int)$body['start'],
            "search" => "",
            "draw" => $body['draw'],
            "limit" => (int)$body['length'],
            "order_column" => $body['order'][0]['name'],
            "order_direction" => $body['order'][0]['dir'],
        ];

        $user_service = new UserService();

        $count = $user_service->count_users($params['search']);
        $users = $user_service->get_users(
            $params['start'],
            $params['limit'],
            $params['search'],
            $params['order_column'],
            $params['order_direction']
        );

        foreach ($users as $id => $user) {
            $users[$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                '<button type="button" class="btn btn-warning" onclick="UserService.open_edit_user_modal('. $user['id'] .')">Edit</button>' .
                '<button type="button" class="btn btn-danger" onclick="UserService.delete_user('. $user['id'] .')">Delete</button>' .
                '</div>';
        }
        Flight::json([
            'draw' => $params['draw'],
            'data' => $users,
            'recordsFiltered' => $count['count'],
            'recordsTotal' => $count['count'],
            'end' => $count['count']
        ], 200);
    });




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


    Flight::route('GET /@user_id', function ($user_id) {
        if($user_id == NULL || $user_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $user_service = new UserService();
        $data = $user_service->getUserById($user_id);

        if (!$data) {
            Flight::halt(404, "Table not found!");
        }

        Flight::json(['data' => $data, 'message' => "successfull"]);
    });


    Flight::route('DELETE /@user_id', function ($user_id) {
        if($user_id == NULL || $user_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $user_service = new UserService();
        $user_service->deleteUserById($user_id);

        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the user"]);
    });


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
<?php

require_once __DIR__ . '/../services/auth.service.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function() {


    /**
     * @OA\Post(
     *      path="/auth/all",
     *      tags={"auth"},
     *      summary="Log in using email and password",
     *      @OA\Response(
     *           response=200,
     *           description="User data and JWT"
     *      ),
     *     @OA\RequesrBody(
     *            description:"Creditentials",
     *     @OA\JsonContent(
     *     required= {"email,"password"},
 *            @OA\Property (property="email", type="string", example="example@example.com", description = "user email"),
     *        @OA\Property (property="password", type="string", example="123", description = "user password")
     *       )
     * )
     */


Flight::route('POST /login' , function (){
    $payload = Flight::request()->data->getData();

    $user = Flight::get('auth.service')->getUserByEmail($payload['email']);

    if(!$user || !password_verify($payload['password'], $user['password'])){
        Flight:: halt(500,"Invalid username or password");
    }
    unset($user['password']);

    $payload = [
        'user' => $user,
        'iat' => time(), // issued at
        'exp' => time() + 100000 // valid for 1 minute
    ];

    $token = JWT::encode(
        $payload,
        Config::JWT_SECRET(),

        'HS256'
    );

    Flight::json([
        'user' => array_merge($user, ['token' => $token]),
        'token' => $token
    ]);
});

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      tags={"auth"},
     *      summary="Logout from system",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Success response or exception"
     *      ),
     * )
     */


    Flight::route('POST /logout', function() {
        try {
            $token = Flight::request()->getHeader('Authentication');
            if($token){
                $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
                Flight::json([
                    'jwt_decoded' => $decoded_token,
                    'user' => $decoded_token->user
                ]);
            }
        } catch (\Exception $e){
            Flight::halt(500, $e->getMessage());
        }
    });
});
<?php
include_once 'config/config.php';
include_once 'services/user.service.php';

$userService = new UserService($conn);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get all users
    if (isset($_GET['users'])) {
        $users = $userService->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }
}

?>
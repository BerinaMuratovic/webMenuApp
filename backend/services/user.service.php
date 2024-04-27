<?php
include_once 'dao/UserDAO.php';

class UserService {
    private $userDAO;

    public function __construct($conn) {
        $this->userDAO = new UserDAO($conn);
    }

    public function getAllUsers() {
        return $this->userDAO->getAllUsers();
    }

    // Other methods to interact with UserDAO
}
?>

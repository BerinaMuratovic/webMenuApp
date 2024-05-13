<?php
require_once dirname(__DIR__) . '/dao/UserDao.php';

class UserService {
    private UserDao $user_dao;

    public function __construct() {
        $this->user_dao = new UserDao();
    }

    public function getAllUsers(): array {
        return $this->user_dao->getAllUsers();
    }

}
?>

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
    public function deleteUserById($user_id) {
        return $this->user_dao->deleteUserById($user_id);
    }
    public function getUserById($user_id) {
        return $this->user_dao->getUserById($user_id);
    }
    public function addUser($user)
    {
        $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);
        return $this->user_dao->add($user);
    }
}
?>

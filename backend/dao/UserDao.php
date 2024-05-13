<?php

require_once __DIR__ . '/../dao/BaseDao.php';

class UserDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("users");
    }

    public function getAllUsers(): array
    {
        return $this->get_all(0, 100);
    }
    public function deleteUserById($user_id)
    {
        $this->execute("DELETE FROM users WHERE id = :id", ["id" => $user_id]);
    }
    public function getUserById($user_id)
    {
        return $this->get_by_id($user_id);
    }
    public function addUser($user)
    {
        return $this->add('users', $user);
    }
}
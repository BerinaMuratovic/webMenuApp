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
}
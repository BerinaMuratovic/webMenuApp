<?php
require_once dirname(__DIR__) . '/dao/AuthDao.php';

class AuthService
{
    private AuthDao $auth_dao;

    public function __construct()
    {
        $this->auth_dao = new AuthDao();
    }

    public function getUserByEmail($email){
        return $this->auth_dao->getUserByEmail($email);

    }



}
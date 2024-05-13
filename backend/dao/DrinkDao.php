<?php
require_once __DIR__ . '/../dao/BaseDao.php';
class drinkDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("drinks");
    }

    public function getAllDrinks(): array
    {
        return $this->get_all(0, 100);
    }
}
<?php
require_once __DIR__ . '/../dao/BaseDao.php';
class MainDishDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("main_dish");
    }

    public function getAllMainDishes(): array
    {
        return $this->get_all(0, 100);
    }

}
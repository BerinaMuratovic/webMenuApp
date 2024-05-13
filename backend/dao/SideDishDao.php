<?php
require_once __DIR__ . '/../dao/BaseDao.php';
class sideDishDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("side_dish");
    }

    public function getAllSideDishes(): array
    {
        return $this->get_all(0, 100);
    }

}
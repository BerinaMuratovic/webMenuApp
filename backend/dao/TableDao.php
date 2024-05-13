<?php

require_once __DIR__ . '/../dao/BaseDao.php';
class TableDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("tables");
    }

    public function getAllTables(): array
    {
        return $this->get_all(0, 100);
    }

}
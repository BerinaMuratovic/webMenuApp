<?php

require_once __DIR__ . '/../dao/BaseDao.php';
class TableDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("tables");
    }

    public function add($table) {
        return $this->insert('tables', $table);
    }

    public function getAllTables(): array
    {
        return $this->get_all(0, 100);
    }
    public function deleteTableById($table_id)
    {
        $this->execute("DELETE FROM tables WHERE id = :id", ["id" => $table_id]);
    }
    public function getTableById($table_id): array
    {
        return $this->get_by_id($table_id);
    }

}

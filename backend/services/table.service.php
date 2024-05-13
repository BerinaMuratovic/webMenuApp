<?php
require_once dirname(__DIR__) . '/dao/TableDao.php';

class TableService {
    private TableDao $table_dao;

    public function __construct() {
        $this->table_dao = new TableDao();
    }

    public function getAllTables(): array {
        return $this->table_dao->getAllTables();
    }
    public function deleteTableById($table_id) {
        return $this->table_dao->deleteTableById($table_id);
    }
    public function getTableById($table_id) {
        return $this->table_dao->getTableById($table_id);
    }
    public function addTable($addTable)
    {
        return $this->table_dao->add($addTable);
    }
}

?>

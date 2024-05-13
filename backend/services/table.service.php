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

}
?>

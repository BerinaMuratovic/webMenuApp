<?php
require_once dirname(__DIR__) . '/dao/SideDishDao.php';

class SideDishService {
    private SideDishDao $sideDish_dao;

    public function __construct() {
        $this->sideDish_dao = new SideDishDao();
    }

    public function getAllSideDishes(): array {
        return $this->sideDish_dao->getAllSideDishes();
    }

}
?>

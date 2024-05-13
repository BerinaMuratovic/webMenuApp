<?php
require_once dirname(__DIR__) . '/dao/DrinkDao.php';

class DrinkService {
    private DrinkDao $drink_dao;

    public function __construct() {
        $this->drink_dao = new DrinkDao();
    }

    public function getAllDrinks(): array {
        return $this->drink_dao->getAllDrinks();
    }

}
?>

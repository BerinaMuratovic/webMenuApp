<?php
require_once dirname(__DIR__) . '/dao/MainDishDao.php';

class MainDishesService {
    private MainDishDao $mainDish_dao;

    public function __construct() {
        $this->mainDish_dao = new MainDishDao();
    }

    public function getAllMainDishes(): array {
        return $this->mainDish_dao->getAllMainDishes();
    }

}
?>


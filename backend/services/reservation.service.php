<?php
require_once dirname(__DIR__) . '/dao/ReservationDao.php';

class ReservationService {
    private ReservationDao $reservation_dao;

    public function __construct() {
        $this->reservation_dao = new ReservationDao();
    }

    public function getAllReservations(): array {
        return $this->reservation_dao->getAllReservations();
    }

}
?>


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

    public function deleteReservationById($reservation_id) {
        return $this->reservation_dao->deleteReservationById($reservation_id);
    }
    public function getReservationById($reservation_id) {
        return $this->reservation_dao->getReservationById($reservation_id);
    }

    public function addReservation($reservation)
    {
        return $this->reservation_dao->addReservation($reservation);
    }
}
?>


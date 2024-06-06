<?php
require_once __DIR__ . '/../dao/BaseDao.php';
class ReservationDao extends BaseDao
{


    public function __construct()
    {
        parent::__construct("reservations");
    }

    public function getAllReservations(): array
    {
        return $this->get_all(0, 100);
    }

    public function deleteReservationById($reservation_id)
    {
        $this->execute("DELETE FROM reservations WHERE id = :id", ["id" => $reservation_id]);
    }
    public function getReservationById($reservation_id)
    {
        return $this->get_by_id($reservation_id);
    }

    public function addReservation($reservation)
    {
        return $this->insert('reservations', $reservation);
    }


}
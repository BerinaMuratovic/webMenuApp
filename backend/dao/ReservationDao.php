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


}
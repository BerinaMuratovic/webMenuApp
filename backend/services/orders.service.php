<?php
require_once dirname(__DIR__) . '/dao/OrderDao.php';

class OrdersService {
    private OrderDao $order_dao;

    public function __construct() {
        $this->order_dao = new OrderDao();
    }

    public function addOrder($addOrder)
    {
        return $this->order_dao->addOrder($addOrder);
    }

    public function getAllOrders(): array {
        return $this->order_dao->getAllOrders();
    }

    public function getOrderById($order_id) {
        return $this->order_dao->getOrderById($order_id);
    }

    public function deleteOrderById($order_id) {
        return $this->order_dao->deleteOrderById($order_id);
    }
}
?>

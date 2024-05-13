<?php

require_once __DIR__ . '/../dao/BaseDao.php';
class OrderDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("orders");
    }

    public function getAllOrders(): array
    {
        return $this->get_all(0, 100);
    }
    public function deleteOrderById($order_id)
    {
        $this->execute("DELETE FROM orders WHERE id = :id", ["id" => $order_id]);
    }
    public function getOrderById($order_id)
    {
        return $this->get_by_id($order_id);
    }

    public function addOrder($order)
    {
        return $this->insert('orders', $order);
    }

}
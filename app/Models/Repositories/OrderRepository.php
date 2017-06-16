<?php

namespace Models\Repositories;

use Models\Entities\Order;
use PDO;

class OrderRepository extends BaseRepository
{
    private $sqlInsert = 'INSERT INTO orders 
                          (total, date, status, userId)
                          VALUES (:total, :orderDate, :status, :userId)';

    public function insert(Order $order)
    {
        $dataArray = [
            'total' => $order->getTotal(),
            'orderDate' => $order->getDate()->format('Y-m-d H:i:s'),
            'status' => $order->getStatus(),
            'userId' => $order->getUserId()
        ];
        return $this->db->prepare($this->sqlInsert)->execute($dataArray);
    }

    public function getStatistic3()
    {
        $sql = 'SELECT orders.id, user_master.email, orders.date FROM orders
                LEFT JOIN user_master
                ON user_master.id = orders.userId
                where WEEKDAY(orders.date) < 5
                ORDER BY orders.date DESC
                LIMIT :lim';

        $limit = 500;
        $query = $this->db->prepare($sql);
        $query->bindParam(':lim', $limit, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll();
    }
}

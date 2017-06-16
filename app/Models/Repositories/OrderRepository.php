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
}


//SELECT count(id) FROM camo_test.orders;
////
//SELECT SUM(orders.total) AS total_sum, user_master.id FROM user_master
//LEFT JOIN orders ON user_master.id = orders.userId
//WHERE orders.status = 2
//GROUP BY orders.userId
//ORDER BY total_sum DESC
//limit 500;
//
//SELECT user_master.id FROM user_master
//LEFT JOIN orders
//ON  orders.status = 2 AND user_master.id = orders.userId AND orders.date >= NOW() - INTERVAL 1 YEAR
//WHERE orders.id IS NULL
//ORDER BY user_master.registrationDate DESC
//limit 500;

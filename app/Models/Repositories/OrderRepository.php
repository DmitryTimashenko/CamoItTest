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
//
//SELECT SQL_CACHE sum(orders.total) as total_sum, user_master.id from user_master
//LEFT JOIN orders ON user_master.id = orders.userId
//where orders.status = 2
//group by orders.userId
//ORDER BY total_sum DESC
//limit 500;
//
// SELECT SQL_CACHE sum(orders.total) as total_sum, user_master.firstname  from orders
//LEFT JOIN user_master ON orders.userId = user_master.id
//where orders.status = 2
//group by orders.userId
//ORDER BY total_sum DESC
//limit 500;
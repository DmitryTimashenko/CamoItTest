<?php
namespace Models\Repositories;

use Models\Entities\Order;
use Models\Entities\User;
use PDO;

class UserRepository extends BaseRepository
{
    private $sqlInsert = 'INSERT INTO user_master 
                          (email, firstname, lastname, registrationDate)
                          VALUES (:email, :firstname, :lastname, :registrationDate)';

    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM user_master');
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $query->fetchAll();
    }

    public function insert(User $user)
    {
        $dataArray = [
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'registrationDate' => empty($user->getRegistrationDate()) ? 'NULL' :
                    $user->getRegistrationDate()->format('Y-m-d')
        ];
        return $this->db->prepare($this->sqlInsert)->execute($dataArray);
    }


    public function getStatistic1()
    {
        $sql = 'SELECT SUM(orders.total) AS total_sum, user_master.id FROM user_master
                LEFT JOIN orders ON orders.userId = user_master.id
                WHERE orders.status = :stat
                GROUP BY orders.userId
                ORDER BY total_sum DESC
                limit :lim';

        $limit = 500;
        $status = Order::STATUS_SUCCESS;
        $query = $this->db->prepare($sql);
        $query->bindParam(':lim', $limit, PDO::PARAM_INT);
        $query->bindParam(':stat', $status, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll();
    }

}


//SELECT * FROM user_master
//LEFT JOIN orders
//ON  orders.status = 2 AND user_master.id = orders.userId AND orders.date >= NOW() - INTERVAL 1 YEAR
//WHERE orders.id IS NULL
//ORDER BY user_master.registrationDate DESC
//limit 500;
//
//SELECT orders.id, user_master.email, orders.date FROM orders
//LEFT JOIN user_master
//ON user_master.id = orders.userId
//where WEEKDAY(orders.date) < 5
//ORDER BY orders.date DESC
//LIMIT 500;
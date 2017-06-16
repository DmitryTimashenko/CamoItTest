<?php
namespace Controllers;

use Core\Database;
use Models\Entities\Order;
use Models\Entities\User;

class Home extends Controller
{
    public function index()
    {
        /** @var \Models\Repositories\UserRepository $userRepository */
        $userRepository = $this->getRepository('UserRepository');

        $this->view('home/index', [
            'users' => $userRepository->getAll()
        ]);
    }

    public function statistic1()
    {
        /** @var \Models\Repositories\UserRepository $userRepository */
        $userRepository = $this->getRepository('UserRepository');

        $this->view('home/statistic1', [
            'data' => $userRepository->getStatistic1()
        ]);
    }

    public function generateUsers()
    {
        set_time_limit(3600);

        $db = Database::connect()->database;
        /** @var \Models\Repositories\UserRepository $userRepository */
        $userRepository = $this->getRepository('UserRepository');

        $names = file("names.txt", FILE_IGNORE_NEW_LINES);
        $lastnames = file("lastnames.txt", FILE_IGNORE_NEW_LINES);
        $namesKeys = array_rand($names, 1000);
        $lastnamesKeys = array_rand($lastnames, 1000);
        $dateReg = new \DateTime('2014-01-01');

        $i = 0;
        foreach ($namesKeys as $nameK) {
            $db->beginTransaction();

            foreach ($lastnamesKeys as $lastnamek) {
                $user = new User();
                $user->setEmail($i . '@gmail.com')
                    ->setFirstname($names[$nameK])
                    ->setLastname($lastnames[$lastnamek])
                    ->setRegistrationDate($dateReg);
                $userRepository->insert($user);
                $i++;
            }
                $db->commit();
        }
    }

    public function generateOrders()
    {
        set_time_limit(3600);

        $db = Database::connect()->database;
        /** @var \Models\Repositories\OrderRepository $orderRepository */
        $orderRepository = $this->getRepository('OrderRepository');

        $startDate = new \DateTime('2016-01-01');
        $startTimestamp = $startDate->getTimestamp();
        $currentTimestamp = time();
        $order = new Order();
        for ($i = 1; $i <= 1500000; $i++) {
            if (($i % 1000) == 1) {
                $db->beginTransaction();
            }
            $randStamp = rand($startTimestamp, $currentTimestamp);
            $date = \DateTime::createFromFormat('U', $randStamp);
            $order->setStatus(rand(0, 2))
                ->setTotal(rand(1,100))
                ->setUserId(rand(1,1000000))
                ->setDate($date);

            $orderRepository->insert($order);
            if (($i % 1000) == 0) {
                $db->commit();
            }
        }

    }
}
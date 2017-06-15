<?php
namespace Controllers;

use Core\Database;
use Models\Entities\User;

class Home extends Controller
{
    public function index()
    {
        /** @var \Models\Repositories\UserRepository $user */
        $userRepository = $this->getRepository('UserRepository');

        $this->view('home/index', [
            'users' => $userRepository->getAll()
        ]);
    }

    public function setData()
    {


        set_time_limit(3600);

        $db = Database::connect()->database;

        /** @var \Models\Repositories\UserRepository $user */
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
                echo $i . '<br>';
            }

                $db->commit();
        }





    }
}
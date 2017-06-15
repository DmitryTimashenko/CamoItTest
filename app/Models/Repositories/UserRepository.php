<?php
namespace Models\Repositories;

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

}
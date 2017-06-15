<?php
namespace Controllers;

class Controller
{
    public function getRepository($name)
    {
        $repository = 'Models\\Repositories\\' . $name;
        return new $repository;
    }

    public function view($view, $data)
    {
        require_once '../app/views/' . $view . '.php';
    }
}
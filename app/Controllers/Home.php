<?php
namespace Controllers;

class Home extends Controller
{
    public function index()
    {
          $this->view('home/index', []);
    }

    public function statistic1()
    {
        /** @var \Models\Repositories\UserRepository $userRepository */
        $userRepository = $this->getRepository('UserRepository');

        $this->view('home/statistic1', [
            'data' => $userRepository->getStatistic1()
        ]);
    }

    public function statistic2()
    {
        /** @var \Models\Repositories\UserRepository $userRepository */
        $userRepository = $this->getRepository('UserRepository');

        $this->view('home/statistic2', [
            'data' => $userRepository->getStatistic2()
        ]);
    }

    public function statistic3()
    {
        /** @var \Models\Repositories\OrderRepository $orderRepository */
        $orderRepository = $this->getRepository('OrderRepository');

        $this->view('home/statistic3', [
            'data' => $orderRepository->getStatistic3()
        ]);
    }
}
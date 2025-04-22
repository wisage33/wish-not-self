<?php

class DashboardController {
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function showDashboard() {
        $results = $this->orderModel->ordersById(1);
        $path = __DIR__ . "/../views/dashboard.php";
        include $path;
    }

    public function ordersById($user_id) {
        return $this->orderModel->ordersById($user_id);
    }
}
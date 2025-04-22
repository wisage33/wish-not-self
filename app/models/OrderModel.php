<?php

class OrderModel {
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = (new Database())->connect();
        } catch (PDOException $e) {
            echo "In OrderModel failed connect to database: ". $e->getMessage();
        }
    }

    public function ordersById($user_id) {

        $query = "SELECT * FROM orders WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        $results = $stmt->fetchAll();
        // header('Content-type: application/json');
        // echo json_encode(['orders' => $results]);
        return $results;
    }
}
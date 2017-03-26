<?php

class Core_Model_Database {
    private $pdo;
    private $host;
    private $user;
    private $pass;
    private $db;
    private $charset;
    private static $conn;

    private function __construct() {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = 'root';
        $this->db = 'framework';
        $this->charset = 'utf8';

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $this->pdo = new PDO($dsn, $this->user, $this->pass);
    }

    public static function getConnection() {
        if (!isset(self::$conn)) {
            echo 'Database connection not made yet! <br />';
            self::$conn = new Core_Model_Database;
        }

        echo 'Database connected! <br />';
        return self::$conn;
    }

    public function select($table, $params = array()) {

        if(count($params) == 3) {
            //$query = "SELECT * FROM {$table} WHERE {$params[0]} {$params[1]} '{$params[2]}'";
            $query = "SELECT * FROM person WHERE firstname = ?";

            //echo $query;
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['Luke']);

        echo "Row count: " . $stmt->rowCount() . '<br />';

//        foreach ($stmt as $row) {
//            echo "Name: " . $row['firstname'] . ' ' . $row['lastname'] . '<br />';
//        }

//        while ($row = $stmt->fetch()) {
//            echo $row['firstname'] . '<br />';
//        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
//        $name =  $row['firstname'] . '<br />';
        return $row;

    }

    public function update() {}

    public function insert() {}

    public function dbConfig() {}
}
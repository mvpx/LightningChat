<?php

class Database {
    
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;

    private $pdo;
    private $stmt;

    public function __construct() {

        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass, $opt);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($sql) {
        $this->stmt = $this->pdo->query($sql);
    }

    public function prepare($sql) {
        $this->stmt = $this->pdo->prepare($sql);
    }

    public function execute($params) {
        return $this->stmt->execute($params);
    }
    
    public function fetch() {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function fetchAll() {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
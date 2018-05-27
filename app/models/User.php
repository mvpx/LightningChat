<?php

class User {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->prepare('INSERT INTO users(name, email, password) 
                            VALUES(?, ?, ?)');

        return $this->db->execute([$data['name'], $data['email'], $data['password']]) ? true : false;
    }

    public function login($email, $password) {
        $this->db->prepare('SELECT * 
                            FROM users 
                            WHERE email = ?');

        $this->db->execute([$email]);

        $result = $this->db->fetch();

        $hashedPassword = $result->password;

        return password_verify($password, $hashedPassword) ? $result : false;
    }

    public function emailExists($email) {
        $this->db->prepare('SELECT COUNT(*) 
                            FROM users 
                            WHERE email = ?');

        $this->db->execute([$email]);
        
        $result = get_object_vars($this->db->fetch());

        return $result['COUNT(*)'] > 0 ? true : false;
    }

    public function getUser($id) {
        $this->db->prepare('SELECT COUNT(*) 
                            FROM users 
                            WHERE id = ?');

        $this->db->execute([$id]);

        return $this->db->fetch();
    }
}
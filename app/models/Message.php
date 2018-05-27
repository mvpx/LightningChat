<?php

class Message {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getMessages() {
        $this->db->query('SELECT users.name, messages.message, created_at
                              FROM messages
                              JOIN users ON messages.user_id = users.user_id
                              ORDER BY messages.created_at DESC
                              LIMIT 6');

        return $this->db->fetchAll();
    }

    public function postMessage($data) {
        $this->db->prepare('INSERT INTO messages(message, user_id)
                                VALUES(?, ?)');

        return $this->db->execute([$data['message'], $data['user_id']]) ? true : false;
    }
}
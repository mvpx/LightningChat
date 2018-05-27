<?php

class Messages extends Controller {

    private $message;
    private $user;

    public function __construct() {
        if (!loggedIn()) {
            redirect('users/login');
        }

        $this->message = $this->model('Message');
        $this->user = $this->model('User');
    }

    public function index() {
        $messages = $this->message->getMessages();

        $messages = json_encode($messages);

        $data = [
            'messages' => $messages
        ];

        $this->view('messages/index', $data);
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'message' => trim($_POST['message'])
            ];

            $this->message->postMessage($data);
         }
    }
}
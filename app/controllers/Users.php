<?php

class Users extends Controller {
    
    private $user;

    public function __construct() {
        $this->user = $this->model('User');
    }

    public function register() {
        if (!$_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'email_error' => '',
            ];

            $this->view('users/register', $data);
        }

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_error' => ''
        ];

        if ($this->user->emailExists($data['email'])) {
            $data['email_error'] = 'Email is already taken.';
        } else {
            $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT );

            if (!$this->user->register( $data )) {
                $this->view( 'users/register', $data );
            }

            redirect( 'users/login' );
        }
    }

    public function login() {
        if (!$_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
            ];

            $this->view('users/login', $data);
        }

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_error' => '',
        ];

        if (!$this->user->emailExists($data['email'])) {
            $data['email_error'] = 'User not found.';
        }

        if (empty($data['email_error'])) {
            $userLoggedIn = $this->user->login($data['email'], $data['password']);

            if ($userLoggedIn) {
                $this->createSession($userLoggedIn);
            } else {
                $this->view('users/login', $data);
            }

        } else {
            $this->view('users/login', $data);
        }
    }

    public function createSession($user) {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('messages');
    }

    public function destroySession() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }
}
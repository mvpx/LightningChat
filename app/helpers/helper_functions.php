<?php

session_start();

function loggedIn() {
    return isset($_SESSION['user_id']) ? true : false;
}

function redirect($page) {
    header('location: ' . URL_ROOT . '/' . $page);
}
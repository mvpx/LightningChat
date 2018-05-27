<?php

class Controller {

    public function model($model) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/LightningChat/app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/LightningChat/app/views/' . $view . '.php')) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/LightningChat/app/views/' . $view . '.php';
        } else {
            die('View does not exist.');
        }
    }
}
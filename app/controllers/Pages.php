<?php

class Pages extends Controller {

    public function index() {
        if (loggedIn()) {
            redirect('messages/index');
        }
        
        $data = [
            'title' => 'LightningChat'
        ];

        $this->view('pages/index', $data);
    }

}
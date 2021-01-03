<?php

use App\Core\View;

class ChatController {

    public function view() {

        View::view('index', [
            'name' => 'Victor'
        ]);

    }

}
<?php

use App\Core\View;
use App\Core\Controller;

class ChatController extends Controller {

    public function view() {
        
        return View::view('index', [
            'name' => 'Victor'
        ]);

    }

}
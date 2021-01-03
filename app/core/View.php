<?php

namespace App\Core;

class View {

    static function view($view, $data = []) {
        
        $viewFile = "app/views/$view.php";

        if (!file_exists($viewFile))
            throw new \Exception("The view $view does not exist");

        require_once($viewFile);

    }

}
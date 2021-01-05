<?php

use App\Core\View;
use App\Core\Controller;
use App\Core\Router;

use Pusher\Pusher;

class ChatController extends Controller {

    public function view() {

        return View::view('index', [
            'sender_id' => time(),
            'chatMessageRoute' => Router::route('chat.sendmessage')
        ]);

    }

    public function sendMessage() {

        $name = !empty($_POST['name']) ? $_POST['name'] : null;
        $message = !empty($_POST['message']) ? $_POST['message'] : null;
        $senderId = !empty($_POST['sender_id']) ? $_POST['sender_id'] : null;
        
        echo $message;

        $pusher = new Pusher(
            $_ENV['PUSHER_KEY'],
            $_ENV['PUSHER_SECRET'],
            $_ENV['PUSHER_ID'],
            array(
                'cluster' => $_ENV['PUSHER_CLUSTER'],
                'useTLS' => true
            )
        );

        $pusher->trigger('chat', 'chat-message', array(
            'message' => $message,
            'senderId' => $senderId,
            'name' => $name
        ));

        return json_encode('asdasdasd');


    }

}
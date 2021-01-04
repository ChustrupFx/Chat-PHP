<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php URL_BASE ?>/css/style.css">
    <title>Teste</title>
</head>
<body class="w-100 vh-100 d-flex justify-content-center align-items-center">

    <div class="w-75">

        <div class="d-flex flex-column border border-dark chat-container">

            <div class="d-flex flex-column message message-other">
                <span class="name">Victor Inácio</span>
                <span>EJGOMRGOIREJHGOIJERHNGIORJEHGOIj</span>
            </div>
            <div class="d-flex flex-column message message-mine">
                <span class="name">Victor Inácio</span>
                <span>EJGOMRGOIR erge er gerg ergEJHGOIrthrth rth rthtr htrhrth JERH NGIORJEHGOIj</span>
            </div>
        
            <div class="d-flex flex-column message message-mine">
                <span class="name">Victor Inácio</span>
                <span>EJGOMRGOIREJHGOIJERHNGIORJEHGOIj</span>
            </div>
        
        </div>

        <input type="text" placeholder="Nome" class="form-control mb-1">
        <textarea name="message" cols="30" rows="5" placeholder="Mensagem" class="form-control"></textarea>
        <input type="submit" class="btn btn-success mt-1" value="Enviar">

    </div>
    
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="<?= URL_BASE ?>/js/script.js"></script>

</body>
</html>
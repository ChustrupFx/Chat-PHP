const pusher = new Pusher('c40e1a057970cdaf64ba', { cluster: 'us2' });
const channel = pusher.subscribe('chat');

channel.bind('chat-message', data => {
    const senderId = $('input[name="sender_id"]').val();
    const chatContainer = $('.chat-container');

    const messageClass = data.senderId === senderId
                            ? 'message-mine' 
                            : 'message-other'

    chatContainer.append(
        `<div class="d-flex flex-column message ${messageClass}">
            <span class="name">${data.name}</span>
            <span>${data.message}</span>
         </div>`
    )
})

$('form#chat-form').submit((e) => {
    e.preventDefault();
    const form = $(e.target);

    $.post({
        url: 'http://localhost:8080/sendmessage',
        data: form.serializeArray(),
    })
})
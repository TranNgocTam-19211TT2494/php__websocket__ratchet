(function() {
    var user;
    var message = [];

    function UpdateMessages(msg) {
        message.push(msg);
        var messages_html = '';
        $('#msger-chat').html(messages_html);
    }

    var conn = new WebSocket('ws://localhost:3000');
    conn.onopen = function (e) {
        console.log(1);
    }

    conn.onmessage = function (e) { 
        var msg = JSON.parse(e.data);
        UpdateMessages(msg);
    }

    
}); 
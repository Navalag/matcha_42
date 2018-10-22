// ------------------------------------------------------ //
// Chat start
// ------------------------------------------------------ //

function showMessage(messageHTML) {
	$('#chat-box').append(messageHTML);
}

var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php");
websocket.onopen = function(event) {
	showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
}
websocket.onmessage = function(event) {
	var Data = JSON.parse(event.data);
	showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
	$('#chat-message').val('');
};

websocket.onerror = function(event){
	showMessage("<div class='error'>Problem due to some Error</div>");
};
websocket.onclose = function(event){
	showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
};

$('#frmChat').on("submit",function(event){
	event.preventDefault();
	$('#chat-user').attr("type","hidden");
	var messageJSON = {
		chat_user: $('#chat-user').val(),
		chat_message: $('#chat-message').val()
	};
	websocket.send(JSON.stringify(messageJSON));

	var url = '/chat/addMessage';
	var tokenName =  $('input[name="csrf_name"]');
	var tokenValue =  $('input[name="csrf_value"]');
	var data = {
        	"chat_id" : $('#chat-id').val(),
			"chat_user" : $('#chat-user').val(),
			"chat_message": $('#chat-message').val(),
			"csrf_name" : tokenName.attr('value'),
			"csrf_value" : tokenValue.attr('value')
		};
	$.post(url, data, function(response) {
		console.log(response);
		var obj = JSON.parse(response);
		tokenName.val(obj.csrf_name);
		tokenValue.val(obj.csrf_value);
	});
});

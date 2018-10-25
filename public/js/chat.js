// ------------------------------------------------------ //
// Chat start
// ------------------------------------------------------ //

function showMessage(messageHTML) {
	$('#chat-box').append(messageHTML);
}

var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php");
websocket.onopen = function(event) {
	// console.log(event);
	console.log('Connection is established!');
	// showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
}
websocket.onmessage = function(event) {
	var Msg = JSON.parse(event.data);
	console.log(Msg);
	if (msgAttr.chat_id == Msg.chat_id) {
		showMessage("<div class='"+Msg.message_type+"'>"+Msg.message+"</div>");
		if (msgAttr.active_user_id == Msg.active_user_id) {
			$('#chat-message').val('');
		}
	}
};

websocket.onerror = function(event) {
	console.log('Please check if socket server is running');
	// showMessage("<div class='error'>Please check if socket server is running</div>");
};
websocket.onclose = function(event) {
	console.log('Connection Closed');
	// showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
};

$('#frmChat').on("submit",function(event){
	event.preventDefault();
	var url = '/chat/addMessage';
	var tokenName =  $('input[name="csrf_name"]');
	var tokenValue =  $('input[name="csrf_value"]');
	var messageText =  $('#chat-message').val();

	var socketMsg = {
		"chat_id": msgAttr.chat_id,
		"active_user_id": msgAttr.active_user_id,
		"active_user_name": msgAttr.active_username,
		"dest_user_id": msgAttr.dest_user_id,
		"dest_user_name": msgAttr.dest_username,
		"chat_message": messageText
	};
	websocket.send(JSON.stringify(socketMsg));

	var ajaxMsg = {
		"chat_id": msgAttr.chat_id,
		"active_user_id": msgAttr.active_user_id,
		"dest_user_id": msgAttr.dest_user_id,
		"chat_message": messageText,
		"csrf_name" : tokenName.attr('value'),
		"csrf_value" : tokenValue.attr('value')
	};
	$.post(url, ajaxMsg, function(response) {
		// console.log(response);
		var obj = JSON.parse(response);
		tokenName.val(obj.csrf_name);
		tokenValue.val(obj.csrf_value);
	});
});

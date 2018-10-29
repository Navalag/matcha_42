// ------------------------------------------------------ //
// Unmatch button
// ------------------------------------------------------ //

function sendUnmatchSocket(destUserId) {
	/*
	** send socket notification
	*/
	var socketMsg = {
		"type": 'unmatch',
		"chat_id": 'null',
		"active_user_id": globalUser.user.id,
		"active_user_name": 'null',
		"dest_user_id": destUserId,
		"dest_user_name": 'null',
		"chat_message": 'null'
	};
	websocket.send(JSON.stringify(socketMsg));
}

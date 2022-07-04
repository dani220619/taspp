const express = require('express');
const body_parser = require('body-parser');
const cookie_parser = require('cookie-parser');
const io = require('socket.io')();
const app = express();
const http = require('http');
const cors = require('cors');
const server = http.createServer(app);

app.use(express.json()); // Initialize express json
app.use(express.urlencoded({ extended : true })); // Initialize express url encoded
app.use(body_parser.json());  // Initialize body parser
app.use(cookie_parser()); // Initialize cookie parser
app.use(cors({
	origin : function(origin, callback) {
		callback(null, true);
	},
	credentials: true
})); // Initialize cors


io.on('connect', socket => {
	socket.on('join_chat_room', room => {
		socket.join(room);
		// emit to joined client
		socket.on('message_chat_room', data => {
			socket.emit('message_chat_room', {
				room: data.room,
				from: data.from,
				message: data.message
			});
		})
	});

	socket.on('admin_joined_room', data => {
		io.of('/').emit('admin_joined_room', data);
	});

	// chat room global event message_chat_room
	socket.on('message_chat_room', data => {
		if (data.chat_room !== null) {
			if (data.chat_room.status == 'menunggu') {
				io.of('/').emit('admin_notification', {
					type: 'new_chat_room',
					data_id: data.chat_room.id
				});
			}

			socket.to(data.chat_room.id).emit('message_chat_room', {
				room: data.chat_room.id,
				from: data.from,
				message: data.message
			});
		}
	});

	socket.on('close_chat_room', data => {
		socket.to(data).emit('close_chat_room', data);
	});
});

io.listen(server.listen(process.env.PORT)); // Socket.io listening on HTTP / Default port
// io.listen(server.listen(8081)); // Socket.io listening on HTTP / Default port

console.log("Websocket server running on port %d", server.address().port)
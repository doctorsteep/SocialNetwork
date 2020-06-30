var messagesHistory = '';

function sendMessage() {
	var mess = $("#messageID").val();
	// Отсылаем паметры
	$.ajax({type: "POST", url: "vendor/message_m.php?t=sendMessage&chat_id=" + chat_id, data:"mess=" + mess, success: function(html) {
			loadMessages();
			$("#messageID").val('');
		}
	});
}

//Функция загрузки сообщений
function loadMessages() {
	$.ajax({type: "POST", url:  "vendor/message_m.php?t=loadMessages&chat_id=" + chat_id, data: "req=ok", success: function(html) {
			$("#messagePageList").empty();
			$("#messagePageList").append(html);
			if (messagesHistory != html) {
				messagesHistory = html;
				$("#messagePageList").scrollTop(90000);
			}
			// 
		}
	});
}


function removeMessage(chat_id, message_id) {
	$.ajax({type: "POST", url:  "vendor/message_m.php?t=removeMessage&chat_id=" + chat_id + "&message_id=" + message_id, data: "req=ok", success: function(html) {
			loadMessages();
		}
	});
}

function intervalLoadMessage() {
	setInterval(loadMessages,3000);
}

function openChat(argument) {
	// chat_id = argument;
	// loadMessages();
	window.location = 'im.php?chat=' + argument;
}
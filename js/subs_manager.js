function sendSub(id_user) {
	$.ajax({type: "POST", url: "vendor/subs.php?t=add", data:"id_other=" + id_user, success: function(html) {
			addingFriend(html);
		}
	});
}

function checkSub(id_user) {
	$.ajax({type: "POST", url: "vendor/subs.php?t=check", data:"id_other=" + id_user, success: function(html) {
			checkFriend(html);
		}
	});
}

function checkMySub(id_user) {
	$.ajax({type: "POST", url: "vendor/subs.php?t=checkSub", data:"id_other=" + id_user, success: function(html) {
			checkMyFriend(html);
		}
	});
}

function addingFriend(state) {
	if (state == 'true') {
		document.getElementById('subBtn').classList.add('edit');
		document.getElementById('subBtn').textContent = 'Вы подписаны';
	} if (state == 'false') {
		document.getElementById('subBtn').classList.remove('edit');
		document.getElementById('subBtn').textContent = 'Подписаться';
	}
}

function checkFriend(state) {
	if (state == 'false') {
		document.getElementById('subBtn').classList.add('edit');
		document.getElementById('subBtn').textContent = 'Вы подписаны';
	} if (state == 'true') {
		document.getElementById('subBtn').classList.remove('edit');
		document.getElementById('subBtn').textContent = 'Подписаться';
	}
}
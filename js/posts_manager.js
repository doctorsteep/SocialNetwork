function sendPost() {
	var mess = $("#postID").val();
	var image = $("#imageInput").val();
	var titleListPost = document.getElementById('titleListPost');
	// Отсылаем паметры
	$.ajax({type: "POST", url: "vendor/user_posts.php?t=send", data:"mess=" + mess + "&image=" + image, success: function(html) {
			loadPosts();
			$("#postID").val('');
			$("#imageInput").val('');
			titleListPost.textContent = '';
		}
	});
}

//Функция загрузки сообщений
function loadPosts() {
	$.ajax({type: "POST", url:  "vendor/user_posts.php?t=load", data: "req=ok", success: function(html) {
			$("#userPosts").empty();
			$("#userPosts").append(html);
			// $("#userPosts").scrollTop(90000);
		}
	});
}


function postLike(id) {
	$.ajax({type: "POST", url:  "vendor/user_posts.php?t=like&post=" + id, data: "req=ok", success: function(html) {
			loadPosts();
		}
	});
}
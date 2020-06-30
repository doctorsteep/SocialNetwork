function loadPosts() {
	$.ajax({type: "POST", url:  "../vendor/subscribed_users_posts.php?t=load", data: "req=ok", success: function(html) {
			$("#postsSubs").empty();
			$("#postsSubs").append(html);
		}
	});
}
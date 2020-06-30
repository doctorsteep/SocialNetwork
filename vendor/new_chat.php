<?php
	session_start();
	include 'connect.php';

	$id_user = intval($_GET['id_user']);

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '') {
		if ($type === 'load') {
			?>
				<h2 class="no_posts">Для того чтобы написать, войдите в аккаунт</h2>
			<?php
		}
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
		$user_id_get = intval($_SESSION['user_view_id']);

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$my_id = intval($user['id']);
			
			$check_chat = mysqli_query($connect, "SELECT * FROM `user_chats` WHERE `user1` = '$my_id' AND `user2` = '$id_user' OR `user1` = '$id_user' AND `user2` = '$my_id'");
			if (mysqli_num_rows($check_chat) > 0) {
				$chat = mysqli_fetch_assoc($check_chat);
				echo('<script type="text/javascript">window.location = \'../im.php?chat=' . intval($chat['id']) . '\';' . '</script>');

				header('location: im.php?chat=' . $chat['id']);
			} else {
				$res = mysqli_query($connect, "INSERT INTO `user_chats` (`user1`,`user2`) VALUES ('$my_id','$id_user')");
				if ($res) {
					$check_chat2 = mysqli_query($connect, "SELECT * FROM `user_chats` WHERE `user1` = '$my_id' AND `user2` = '$id_user' OR `user1` = '$id_user' AND `user2` = '$my_id'");
					if (mysqli_num_rows($check_chat2) > 0) {
						$chat2 = mysqli_fetch_assoc($check_chat2);
						echo('<script type="text/javascript">window.location = \'../im.php?chat=' . intval($chat2['id']) . '\';' . '</script>');
						header('location: im.php?chat=' . $chat2['id']);
					}
				}
			}
		}
	}
?>
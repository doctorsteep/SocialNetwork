<?php
	session_start();
	include 'connect.php';
	include '../lang/language.php';

	$type = $_GET['t'];

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '' && $_SESSION['user_view_id'] === '') {
		?>
			<h2>Чтобы взаимодействовать с пользователями, войдите в аккаунт</h2>
		<?php
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
		$user_id_get = intval($_SESSION['user_view_id']);

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$my_id_get = intval($user['id']);
			$other_id = mysqli_real_escape_string($connect, intval($_POST['id_other']));

			if ($type == 'add') {
				$check_sub = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$my_id_get' AND `friend2` = '$other_id'");
				if (mysqli_num_rows($check_sub) > 0) {
					$result = mysqli_query($connect ,"DELETE FROM `subs` WHERE `friend1` = '$my_id_get' AND `friend2` = '$other_id'");
					echo('false');
				} else {
					$result = mysqli_query($connect, "INSERT INTO subs (friend1,friend2) VALUES ('$my_id_get','$other_id')");
					echo('true');
				}
			}



			if ($type == 'check') {
				$check_sub = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$my_id_get' AND `friend2` = '$other_id'");
				if (mysqli_num_rows($check_sub) > 0) {
					echo('false');
				} else {
					echo('true');
				}
			}
		}
	}
?>
<?php
	session_start();
	include '../connect.php';

	$site = mysqli_real_escape_string($connect, $_POST['site']);
	$vk = mysqli_real_escape_string($connect, $_POST['vk']);
	$instagram = mysqli_real_escape_string($connect, $_POST['instagram']);
	$phone = mysqli_real_escape_string($connect, intval($_POST['phone']));

	$email = $_SESSION['user_email'];
	$password = $_SESSION['user_password'];

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

	if (mysqli_num_rows($check_user) > 0) {
		$user = mysqli_fetch_assoc($check_user);
		$sql_update = mysqli_query($connect ,"UPDATE `users` SET `site` = '$site', `vk` = '$vk', `instagram` = '$instagram', `phone` = '$phone' WHERE `email` = '$email';");
		if ($sql_update) {
			$_SESSION['message'] = 'Данные профиля обновлены!';
			$_SESSION['message_type'] = 'succes';
			?>
				<script type="text/javascript">
					window.history.go(-1);
				</script>
			<?php
		} else {
			$_SESSION['message'] = 'Данные профиля не удалось обновить!';
			$_SESSION['message_type'] = 'error';
			?>
				<script type="text/javascript">
					window.history.go(-1);
				</script>
			<?php
		}
	} else {
		echo('Войдите в аккаунт!');
	}
?>
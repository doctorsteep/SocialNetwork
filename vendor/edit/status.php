<?php
	session_start();
	include '../connect.php';

	$status = mysqli_real_escape_string($connect, $_POST['status']);

	$email = $_SESSION['user_email'];
	$password = $_SESSION['user_password'];

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

	if (mysqli_num_rows($check_user) > 0) {
		$user = mysqli_fetch_assoc($check_user);
		$sql_update = mysqli_query($connect ,"UPDATE `users` SET `description` = '$status' WHERE `email` = '$email';");
		if ($sql_update) {
			?>
				<script type="text/javascript">
					window.history.go(-1);
				</script>
			<?php
		} else {
			echo('Данные профиля не удалось обновить!');
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
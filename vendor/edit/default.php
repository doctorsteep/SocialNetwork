<?php
	session_start();
	include '../connect.php';

	$description = mysqli_real_escape_string($connect, $_POST['description']);
	$first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
	$sex = mysqli_real_escape_string($connect, $_POST['sex']);
	$login = mysqli_real_escape_string($connect, $_POST['login']);
	$family_state = mysqli_real_escape_string($connect, intval($_POST['family_state']));
	$dd = mysqli_real_escape_string($connect, intval($_POST['dd']));
	$mm = mysqli_real_escape_string($connect, intval($_POST['mm']));
	$yy = mysqli_real_escape_string($connect, intval($_POST['yy']));

	$email = $_SESSION['user_email'];
	$password = $_SESSION['user_password'];

	$data_you_happy = $dd . '.' . $mm . '.' . $yy;

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
	$check_username = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");

	if (mysqli_num_rows($check_user) > 0) {
		$user = mysqli_fetch_assoc($check_user);
		if ($first_name === '') {
			$_SESSION['message'] = 'Укажите имя!';
			$_SESSION['message_type'] = 'error';
			header('location: /social/edit.php');
		} else {
			if ($last_name === '') {
				$_SESSION['message'] = 'Укажите фамилию!';
				$_SESSION['message_type'] = 'error';
				header('location: /social/edit.php');
			} else {
				$sql_update = mysqli_query($connect ,"UPDATE `users` SET `description` = '$description', `first_name` = '$first_name', `last_name` = '$last_name', `sex` = '$sex', `family_state` = '$family_state', `login` = '$login', `happy` = '$data_you_happy' WHERE `email` = '$email';");
				if ($user['login'] == $login) {
					saveData($sql_update);
				} else {
					if (mysqli_num_rows($check_username) > 0) {
						$_SESSION['message'] = 'Данная ссылка на профиль, уже используется';
						$_SESSION['message_type'] = 'error';
						?>
							<script type="text/javascript">
								window.history.go(-1);
							</script>
						<?php
					} else {
						saveData($sql_update);
					}
				}
			}
		}
	} else {
		echo('Войдите в аккаунт!');
	}


	function saveData($sql_update) {
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
	}
?>
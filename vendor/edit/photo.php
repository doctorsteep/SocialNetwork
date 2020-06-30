<?php
	session_start();
	include '../connect.php';

	function generateRandomString($length = 10) {
    	return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)) )), 1, $length);
	}

	$type = $_GET['t'];
	$date_curret = date("d.m.Y");
	$device = $_SESSION['type_device'];

	if ($type == 'remove') { // REMOVE AVATAR
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$sql_update = mysqli_query($connect ,"UPDATE `users` SET `avatar` = '' WHERE `email` = '$email';");
			if ($sql_update) {
				?>
					<script type="text/javascript">
						window.history.go(-1);
					</script>
				<?php	
			}
		} else {
			echo('Войдите в аккаунт!');
		}
	}

	if ($type == 'upload') { // UPLOAD AVATAR
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$image_name = generateRandomString(30) . time() . '.png';
			$path = 'uploads/images/' . $image_name;
			if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
				echo('Изображение загрузить не удалось!');
			} else {
				$user = mysqli_fetch_assoc($check_user);
				$user_publisher = intval($user['id']);
				$path_result = 'vendor/' . $path;
				$sql_update = mysqli_query($connect ,"UPDATE `users` SET `avatar` = '$path_result' WHERE `email` = '$email';");
				if ($sql_update) {
					$check_image = mysqli_query($connect, "SELECT * FROM `images` WHERE `url` = '$path_result'");
					if (mysqli_num_rows($check_image) > 0) { } else {
						mysqli_query($connect, "INSERT INTO `images`(`id`, `url`, `publisher`, `name`) VALUES (NULL, '$path_result', '$user_publisher', '$image_name')");
						mysqli_query($connect, "INSERT INTO `user_posts` (`publishing`,`message`,`creator`,`device`,`image`) VALUES ('$user_publisher','Обновлена фотография на странице','$user_publisher','$device', '$path_result')");
					}
					?>
						<script type="text/javascript">
							window.history.go(-1);
						</script>
					<?php	
				}
			}
		} else {
			echo('Войдите в аккаунт!');
		}
	}




	if ($type == 'new') { // UPLOAD NEW PHOTO
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$image_name = generateRandomString(30) . time() . '.png';
			$path = 'uploads/images/' . $image_name;
			if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path)) {
				echo('Изображение загрузить не удалось!');
			} else {
				$user = mysqli_fetch_assoc($check_user);
				$user_publisher = intval($user['id']);
				$path_result = 'vendor/' . $path;
				$check_image = mysqli_query($connect, "SELECT * FROM `images` WHERE `url` = '$path_result'");
				if (mysqli_num_rows($check_image) > 0) { } else {
					mysqli_query($connect, "INSERT INTO `images`(`id`, `url`, `publisher`, `name`) VALUES (NULL, '$path_result', '$user_publisher', '$image_name')");
					?>
						<script type="text/javascript">
							window.history.go(-1);
						</script>
					<?php	
				}
			}
		} else {
			echo('Войдите в аккаунт!');
		}
	}




	if ($type == 'save') { // SAVE PHOTO
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
		$photo = intval($_GET['photo']);

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$user_publisher = intval($user['id']);
			$check_image = mysqli_query($connect, "SELECT * FROM `images` WHERE `id` = '$photo'");
			if (mysqli_num_rows($check_image) > 0) { 
				$image_data = mysqli_fetch_assoc($check_image);
				$url_save = $image_data['url'];
				$name_save = $image_data['name'];
				mysqli_query($connect, "INSERT INTO `images`(`id`, `url`, `publisher`, `name`, `album`) VALUES (NULL, '$url_save', '$user_publisher', '$name_save', 'saved')");
				?>
					<script type="text/javascript">
						window.history.go(-1);
					</script>
				<?php	
			}
		} else {
			echo('Войдите в аккаунт!');
		}
	}



	if ($type == 'set') { // SET PHOTO
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
		$id_avatar = intval($_GET['img']);

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$check_avatar = mysqli_query($connect, "SELECT * FROM `images` WHERE `id` = '$id_avatar'");
			if (mysqli_num_rows($check_avatar) > 0) {
				$avatar_view = mysqli_fetch_assoc($check_avatar);
				$avatar_url = $avatar_view['url'];
				$sql_update = mysqli_query($connect ,"UPDATE `users` SET `avatar` = '$avatar_url' WHERE `email` = '$email';");
				if ($sql_update) {
					?>
						<script type="text/javascript">
							window.history.go(-1);
						</script>
					<?php	
				}
			}
		} else {
			echo('Войдите в аккаунт!');
		}
	}




	if ($type == 'pr') { // REMOVE PHOTO
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
		$id_avatar = intval($_GET['img']);

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$id_publisher = intval($user['id']);
			$check_photo = mysqli_query($connect, "SELECT * FROM `images` WHERE `id` = '$id_avatar'");
			if (mysqli_num_rows($check_photo) > 0) {
				$photo_view = mysqli_fetch_assoc($check_photo);
				if (intval($photo_view['publisher']) === intval($user['id'])) {
					$sql_remove = mysqli_query($connect ,"DELETE FROM `images` WHERE `id` = '$id_avatar' AND `publisher` = '$id_publisher'");
					if ($sql_remove) {
						if ($photo_view['url'] === $user['avatar']) {
							mysqli_query($connect ,"UPDATE `users` SET `avatar` = '' WHERE `email` = '$email';");
						}
						?>
							<script type="text/javascript">
								window.history.go(-1);
							</script>
						<?php	
					} else {
						echo('Фотографию удалить не удалось...');
					}
				} else {
					echo('Вы не являетесь владельцем изображения, фотографию удалить не удалось...');
				}
			}
		} else {
			echo('Войдите в аккаунт!');
		}
	}




	if ($type == 'download') { // DOWNLOAD PHOTO
		echo('Временно данная функция отключена!');
		?>
			<script type="text/javascript">
				window.history.go(-1);
			</script>
		<?php	
	}
?>
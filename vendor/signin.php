<?php
	session_start();
	include 'connect.php';

	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$password = md5(mysqli_real_escape_string($connect, $_POST['password']));

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1");
	if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			if ($user['vemail'] == 1) {
				$_SESSION['user_email'] = $user['email'];
				$_SESSION['user_password'] = $user['password'];
				header('location: ../home.php');
			} else {
				if ($user['vkey'] == '') {
					$vkey = md5(time() . $email);
					mysqli_query($connect ,"UPDATE `users` SET `vkey` = '$vkey' WHERE `email` = '$email';");
					$_SESSION['my_mail'] = $email;
					$to = $email;
					$subject = 'Подтверждение регистрации - Lopper';
					$message = '<h4>Никому не передавайте эту ссылку!</h4><br><a href="https://lopper.fun/mail_verify.php?vkey=' . $vkey . '">Завершить регистрацию</a>';
					$headers = 'From: steepdoctor@gmail.com' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';
					mail($to, $subject, $message, $headers);

					header('location: ../mail_send.php');
				} else {
					$vkey = $user['vkey'];
					$_SESSION['my_mail'] = $email;
					$to = $email;
					$subject = 'Подтверждение регистрации - Lopper';
					$message = '<h4>Никому не передавайте эту ссылку!</h4><br><a href="https://lopper.fun/mail_verify.php?vkey=' . $vkey . '">Завершить регистрацию</a>';
					$headers = 'From: steepdoctor@gmail.com' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';
					mail($to, $subject, $message, $headers);

					header('location: ../mail_send.php');
				}
			}
	} else {
		$_SESSION['message'] = 'Не верно указана почта или пароль';
		$_SESSION['message_type'] = 'error';
		header('location: ../');
	}

?>
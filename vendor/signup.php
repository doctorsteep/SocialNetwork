<?php
	session_start();
	include 'connect.php';

	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
	$sex = mysqli_real_escape_string($connect, $_POST['sex']);
	$dd = mysqli_real_escape_string($connect, intval($_POST['dd']));
	$mm = mysqli_real_escape_string($connect, intval($_POST['mm']));
	$yy = mysqli_real_escape_string($connect, intval($_POST['yy']));
	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$password_confirm = mysqli_real_escape_string($connect, $_POST['password_confirm']);

	$date_curret = date("d.m.Y");
	$data_you_happy = $dd . '.' . $mm . '.' . $yy;
	
	if ($dd === '' || $mm === '' || $yy === '') {
		$data_you_happy = '';
	}

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");

	if (mysqli_num_rows($check_user) > 0) {
		$_SESSION['message'] = 'Пользователь с такой почтой уже зарегистрирован';
		$_SESSION['message_type'] = 'error';
		header('location: ../');
	} else {
		if ($sex === '') {
			$_SESSION['message'] = 'Укажите свой пол';
			$_SESSION['message_type'] = 'error';
			header('location: ../');
		} else {
			if ($email === '') {
				$_SESSION['message'] = 'Поле с почтой не должно быть пустым!';
				$_SESSION['message_type'] = 'warning';
				header('location: ../');
			} else {
				if ($first_name === '') {
					$_SESSION['message'] = 'Укажите своё имя';
					$_SESSION['message_type'] = 'warning';
					header('location: ../');
				} else {
					if ($last_name === '') {
						$_SESSION['message'] = 'Укажите свою фамилию';
						$_SESSION['message_type'] = 'warning';
						header('location: ../');
					} else {
						if ($password === '' || $password_confirm === '') {
							$_SESSION['message'] = 'Установите пароль, для безопасности аккаунта';
							$_SESSION['message_type'] = 'warning';
							header('location: ../');
						} else {
							if ($password === $password_confirm) {
								$password = md5($password);
								$vkey = md5(time() . $email);
								$_SESSION['my_mail'] = $email;
								mysqli_query($connect, "INSERT INTO `users`(`id`, `first_name`, `last_name`, `email`, `password`, `login`, `date_registration`,`sex`,`happy`,`vkey`) VALUES (NULL,'$first_name','$last_name','$email','$password',NULL,'$date_curret','$sex','$data_you_happy','$vkey')");
								$_SESSION['message'] = 'Регистрация прошла успешно!';
								$_SESSION['message_type'] = 'succes';
								$to = $email;
								$subject = 'Подтверждение регистрации - Lopper';
								$message = '<h4>Никому не передавайте эту ссылку!</h4><br><a href="https://Lopper.fun/mail_verify.php?vkey=' . $vkey . '">Завершить регистрацию</a>';
								$headers = 'From: steepdoctor@gmail.com' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';
								mail($to, $subject, $message, $headers);

								header('location: ../mail_send.php');
							} else {
								$_SESSION['message'] = 'Пароли не совпали, повторите попытку';
								$_SESSION['message_type'] = 'error';
								header('location: ../');
							}
						}
					}
				}
			}
		}
	}
?>
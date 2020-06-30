<?php
	session_start();
	include 'lang/language.php';
	include 'style/style.php';
	include 'vendor/connect.php';
	require_once "libs/Mobile_Detect.php";
	$detect_device = new Mobile_Detect;
?>
<!DOCTYPE html>
<html lang="<?php echo($string_type_lang); ?>">
	<head>
		<title><?php echo($string_confirm_finish); ?></title>
		<link rel="shortcut icon" href="<?php echo($url_favicon_img); ?>" type="image/png">
		<meta charset="utf-8">
		<meta name="description" content="<?php echo($string_confirm_finish) ?>">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<style type="text/css">
			img.mail {
				width: 90px;
				height: 90px;
			}
		</style>
		<?php 
			$vkey = $_GET['vkey'];
			mysqli_query($connect ,"UPDATE `users` SET `vemail` = 1 WHERE `vkey` = '$vkey';");
		?>
		<center>
			<img src="assets/icons/ic_mail_send.png" class="mail">
			<h2><?php echo($string_confirm_finish); ?></h2>
			<?php 
				$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `vkey` = '$vkey'"); 
				if (mysqli_num_rows($check_user) > 0) {
					$user = mysqli_fetch_assoc($check_user);
					?>
						<h4><?php if ($user['vemail'] == 1) { echo($string_confirm_finish_text2); } else { echo($string_confirm_finish_text); }  ?></h4>
						<a href="/"><?php echo($string_signin); ?></a>
					<?php
				} else {
					?>
						<h4><?php echo($string_confirm_finish_text3); ?></h4>
					<?php
				}
			?>
		</center>
	</body>
</html>
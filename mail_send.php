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
		<title><?php echo($string_confirm_mail); ?></title>
		<link rel="shortcut icon" href="<?php echo($url_favicon_img); ?>" type="image/png">
		<meta charset="utf-8">
		<meta name="description" content="<?php echo($string_confirm_mail) ?>">
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
		<center>
			<img src="assets/icons/ic_mail_send.png" class="mail">
			<h2><?php echo($string_confirm_mail); ?></h2>
			<h4><?php echo($string_confirm_mail_text); ?> <strong><?php echo($_SESSION['my_mail']); ?></strong> <?php echo($string_confirm_mail_text2); ?> <a href="#"><?php echo($string_confirm_mail_text3); ?></a></h4>
		</center>
	</body>
</html>
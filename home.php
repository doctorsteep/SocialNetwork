<?php
	session_start();
	include 'lang/language.php';
	include 'style/style.php';
	include 'vendor/connect.php';
	require 'vendor/NCLNameCaseRu.php';
	require_once "libs/Mobile_Detect.php";
	$detect_device = new Mobile_Detect;
	$nc = new NCLNameCaseRu();

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '') {
		header('location: index.php');
		unset($_SESSION['user_email']);
		unset($_SESSION['user_password']);
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$my_id = intval($user['id']);
		} else {
			header('location: index.php');
			unset($_SESSION['user_email']);
			unset($_SESSION['user_password']);
		}
	}
?>

<!DOCTYPE html>
<html lang="<?php echo($string_type_lang); ?>">
	<head>
		<title><?php echo($string_title_home); ?></title>
		<?php if ($detect_device->isMobile()) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default_m); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_home_m); ?>">
		<?php } else { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_home); ?>">
		<?php } ?>
		<link rel="shortcut icon" href="<?php echo($url_favicon_img); ?>" type="image/png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<meta charset="utf-8">
		<meta name="description" content="<?php echo($string_index_description) ?>">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<nav class="bar">
			<img draggable="false" oncontextmenu="return false" src="<?php echo($url_logo_img); ?>" class="logo">
			<?php  if (!$detect_device->isMobile()) { include 'vendor/search_friend.php'; } ?>
			<h2 class="title"><?php echo($title_nav); ?></h2>
			<?php
				if (mysqli_num_rows($check_user) > 0) {
					if ($user['banned'] == 0) {
						echo('<div class="userContent" id="userContent">' . '<!--<h2 class="userName">' . htmlspecialchars($user['first_name']) . '</h2>-->'); 
								if ($user['avatar'] != '') {
									echo('<img draggable="false" oncontextmenu="return false" class="userAvatar" src="' . htmlspecialchars($user['avatar']) . '">');
								} else {
									echo('<img draggable="false" oncontextmenu="return false" class="userAvatar" src="' . $url_no_avatar . '">');
								}
							 	if (!$detect_device->isMobile()) { echo('<i class="arrow down" id="arrow"></i>' . '</div>'); }
						include 'vendor/menu_user.php';
					}
				} else {
					echo('<a href="index.php"><button class="signin">' . $string_signin . '</button></a>');
				}
			?>
		</nav>

		<?php include 'vendor/menu_left.php'; ?>
		<?php
			if ($user['banned'] == 0) {
				?>
				<center><?php include 'vendor/subscribed_users_posts.php'; ?></center>
				<?php
			} else {
				echo('<h2 class="titleBanned">' . $string_banned . '</h2>');
				echo('<h3 class="messageBanned">' . $string_banned_description . '</h3>');
				echo('<hr class="banned">');
				echo('<div class="divBanned"><a href="vendor/logout.php"><button>' . $string_logout .'</button></a></div>');
			}
		?>
		

		<?php
			if ($user['banned'] == 0) {
				if (mysqli_num_rows($check_user) > 0) {
					echo('<script type="text/javascript" src="js/home_user_menu.js?v=1"></script>');
				}
			}
		?>

		<?php if (!$detect_device->isMobile()) { include 'vendor/bottom_hover.php'; } ?>

	</body>
</html>
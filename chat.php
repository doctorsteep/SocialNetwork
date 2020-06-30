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
<html>
	<head>
		<title><?php echo($string_messages); ?></title>
		<?php if ($detect_device->isMobile()) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default_m); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_chat_m); ?>">
		<?php } else { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_chat); ?>">
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
			<?php if (!$detect_device->isMobile()) { ?><img draggable="false" oncontextmenu="return false" src="<?php echo($url_logo_img); ?>" class="logo"><?php } ?>
			<?php if (!$detect_device->isMobile()) { include 'vendor/search_friend.php'; } ?>
			<?php if ($detect_device->isMobile()) { ?><img src="assets/icons/ic_back_blue.png" draggable="false" oncontextmenu="return false" class="imgBackBar" onclick="history.back()"><?php } ?>
			<h2 class="title"><?php if ($detect_device->isMobile()) { ?><?php echo($string_messages); ?><?php } ?></h2>
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
						if (!$detect_device->isMobile()) { include 'vendor/menu_user.php'; }
					}
				} else {
					echo('<a href="index.php"><button class="signin">' . $string_signin . '</button></a>');
				}
			?>
		</nav>


		<div class="contentAll">
			<div class="contentPage">
				<div class="chatsPage">
					<nav class="topBar">
						<div class="bottomMess">
							<div class="itemSea">
								<input autocomplete="on" type="message" id="search_chat" class="mess" placeholder="<?php echo($string_hint_search); ?>">
							</div>
						</div>
					</nav>

					<?php 
							$query_my_chats = mysqli_query($connect, "SELECT * FROM `user_chats` WHERE `user2` = '$my_id' OR `user1` = '$my_id'");
							if (mysqli_num_rows($query_my_chats) > 0) { 
								?>
									<div class="pageListMyChats">
										<?php 
										if ($email != '' && $password != '') {
											if ($user['banned'] == 0) { 
												while($row = mysqli_fetch_assoc($query_my_chats)) {
													if (intval($row['user1']) != $my_id) {
														$id_chat_other_id = intval($row['user1']);
													} if (intval($row['user2']) != $my_id) {
														$id_chat_other_id = intval($row['user2']);
													} if (intval($row['user2']) == $my_id && intval($row['user1']) == $my_id) {

													} else {
													$check_user_other_chat = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_chat_other_id'");
													if (mysqli_num_rows($check_user_other_chat) > 0) {
														$user_item_other_chat = mysqli_fetch_assoc($check_user_other_chat);
											?>
														<div class="itemChatList" onclick="window.location = 'im.php?chat=<?php echo(intval($row['id'])); ?>';">
															<img src="<?php if ($user_item_other_chat['avatar'] == '') { echo($url_no_avatar); } else { echo htmlspecialchars($user_item_other_chat['avatar']); } ?>" class="avatarChatUserTitle" draggable="false" oncontextmenu="return false">
															<div class="nameItemUserChat">
																<h2 class="chatUserName"><?php echo htmlspecialchars($user_item_other_chat['first_name']); ?> <?php echo htmlspecialchars($user_item_other_chat['last_name']); ?></h2>
															</div>
														</div>
										<?php }}}}} ?>
									</div>
								<?php 
							} else {
								?>
									<div class="pageListMyChats">
										<h2 class="no_posts"><?php echo($string_no_my_chats); ?></h2>
									</div>
								<?php 
							}
						?>
				</div>
			</div>
		</div>



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
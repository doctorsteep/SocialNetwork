<?php
	session_start();
	include 'lang/language.php';
	include 'style/style.php';
	include 'vendor/connect.php';
	require 'vendor/NCLNameCaseRu.php';
	require_once "libs/Mobile_Detect.php";
	$detect_device = new Mobile_Detect;

	$chat_id = intval($_GET['chat']);
	$user_id = intval(0);
	$nc = new NCLNameCaseRu();
	$_SESSION['chat_view_id'] = intval($chat_id);

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '') {
		
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$my_id = intval($user['id']);
		}
	}


	if (mysqli_num_rows($check_user) > 0) {
		echo('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>');
		echo('<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>');
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($string_messages); ?></title>
		<?php if ($detect_device->isMobile()) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default_m); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_im_m); ?>">
		<?php } else { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_im); ?>">
		<?php } ?>
		<link rel="shortcut icon" href="<?php echo($url_favicon_img); ?>" type="image/png">
		<meta charset="utf-8">
		<meta name="description" content="<?php echo($string_index_description) ?>">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<?php if (!$detect_device->isMobile()) { ?>
		<nav class="bar">
			<img draggable="false" oncontextmenu="return false" src="<?php echo($url_logo_img); ?>" class="logo">
			<?php include 'vendor/search_friend.php'; ?>
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
							 	echo('<i class="arrow down" id="arrow"></i>' . '</div>');
						include 'vendor/menu_user.php';
					}
				} else {
					echo('<a href="index.php"><button class="signin">' . $string_signin . '</button></a>');
				}
			?>
		</nav>
		<?php } ?>

		<script type="text/javascript">var chat_id = <?php echo(intval($chat_id)); ?></script>


		<?php
			function loadContentChat() { 
				
			}
		?>

		<?php if ($_SESSION['user_email'] != '' && $_SESSION['user_password'] != '') { if ($user['banned'] == 0) { ?>
		<script type="text/javascript" src="js/messages_manager.js?v=4"></script>
		<?php if (!$detect_device->isMobile()) { include 'vendor/menu_left.php'; } ?>
		<div class="contentAll">
			<?php if (!$detect_device->isMobile()) { ?>
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
														<div class="itemChatList" onclick="openChat(<?php echo(intval($row['id'])); ?>)">
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
			<?php } ?>

			<div class="contentPage">
				<div class="homePage">
					<?php
						$check_chat = mysqli_query($connect, "SELECT * FROM `user_chats` WHERE `id` = '$chat_id'");
						if (mysqli_num_rows($check_chat) > 0) {
							$chat = mysqli_fetch_assoc($check_chat);
							$chat_user1 = intval($chat['user1']);
							$chat_user2 = intval($chat['user2']);
							if ($chat_user1 != '' && $chat_user2 != '') {
								if ($chat_user1 != $my_id) {
									$user_id = $chat_user1;
								} if ($chat_user2 != $my_id) {
									$user_id = $chat_user2;
								}
								if ($chat_user1 == $my_id || $chat_user2 == $my_id && $user_id != 0) {
									$check_user_other = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");
									if (mysqli_num_rows($check_user_other) > 0) {
										$user_other = mysqli_fetch_assoc($check_user_other);
										?>
											<!-- CONTENT -->

											<nav class="topBar">
												<?php if ($detect_device->isMobile()) { ?><img src="assets/icons/ic_back_blue.png" draggable="false" oncontextmenu="return false" class="imgBackBar" onclick="history.back()"><?php } ?>
												<h2 class="userNameTopBar"><?php echo htmlspecialchars($user_other['first_name']); ?> <?php echo htmlspecialchars($user_other['last_name']); ?></h2>
												<div class="userMessage" onclick="window.location = 'profile.php?id=<?php echo(intval($user_other['id'])); ?>'">
													<img src="<?php if ($user_other['avatar'] == '') { echo($url_no_avatar); } else { echo htmlspecialchars($user_other['avatar']); } ?>" class="avatarMessageUserTitle" draggable="false" oncontextmenu="return false">
												</div>
											</nav>

											<div id="messagePageList" class="messagePageList">
												<?php 
													$user_messages = mysqli_query($connect, "SELECT * FROM `user_messages` WHERE `chat_id` = '$chat_id'");
													if (mysqli_num_rows($user_messages) > 0) {
														echo('<script type="text/javascript">loadMessages(); intervalLoadMessage();</script>');
													} else {
														echo('<h2 class="no_posts">' . $string_no_messages . '</h2>');
													} 
												?>
											</div>

											<div class="bottomMess">
												<form class="bottomMess" action="javascript:sendMessage();" enctype="multipart/form-data">
													<div class="itemMess">
														<input autocomplete="off" type="message" name="message" id="messageID" class="mess" placeholder="<?php echo($string_hint_message); ?>">
														<button class="send" type="submit"><img draggable="false" oncontextmenu="return false" title="<?php echo($string_send); ?>" src="assets/icons/ic_send_message.png" class="send"></button>
													</div>
												</form>
											</div>
										<?php 
									}
								} else {
									echo('<h2 class="errorMessage">' . $string_no_you_chat . '</h2>');
								}
							} else {
								echo('<h2 class="errorMessage">' . $string_no_users_chat . '</h2>');
							}
						} else {
							echo('<h2 class="errorMessage">' . $string_no_chat . '</h2>');
						}
					?>
				</div>
			</div>
		</div>

		<?php } else { ?>
			<?php 
				echo('<h2 class="nameUser">' . $string_banned . '</h2>');
				echo('<h2 class="descriptionUser"><strong>' . $string_banned . '</strong> ' . $user['text_banned'] . '</h2>');
			?>
		<?php } } ?>



		<?php if (!$detect_device->isMobile()) { ?>
		<?php
			if ($user['banned'] == 0) {
				if (mysqli_num_rows($check_user) > 0) {
					echo('<script type="text/javascript" src="js/home_user_menu.js?v=1"></script>');
				}
			}
		?>
		<?php } ?>
		
	</body>
</html>
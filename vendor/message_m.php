<?php 
	session_start();
	include 'connect.php';
	include '../lang/language.php';

	$type = $_GET['t'];

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '' && $_SESSION['chat_view_id'] === '') {
		if ($type === 'load') {
			echo('Войдите в аккаунт!');
		}
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
		$chat_id = intval($_GET['chat_id']);

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$my_id_get = intval($user['id']);

			$check_chat = mysqli_query($connect, "SELECT * FROM `user_chats` WHERE `id` = '$chat_id'");
			if (mysqli_num_rows($check_chat) > 0) {
				$user_chat = mysqli_fetch_assoc($check_chat);
				if (intval($user_chat['user1']) == $my_id_get || intval($user_chat['user2']) == $my_id_get) {


					if ($type === 'loadMessages') {
						$res = mysqli_query($connect, "SELECT * FROM `user_messages` WHERE `chat_id` = '$chat_id'");
						//Выводим все сообщения на экран
						while($row = mysqli_fetch_assoc($res)) { 
							$creator = intval($row['creator']);
							$check_user_message = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$creator'");
							if (mysqli_num_rows($check_user_message) > 0) {
								$user_message_i = mysqli_fetch_assoc($check_user_message);
								?>
									<div class="itemMessage">
										<!--  -->
										<div class="messageContentItem <?php if (intval($row['creator']) != $my_id_get) { echo('otherMessageContentItem'); } ?> <?php if (intval($row['creator']) != $my_id_get) { echo('iMessageContentItem'); } ?>">
											<div class="sdfhhghbvxhcb">
												<?php if (intval($row['creator']) != $my_id_get) { ?>
													<img src="<?php if ($user_message_i['avatar'] == '') { echo ($url_no_avatar); } else { echo htmlspecialchars($user_message_i['avatar']); } ?>" class="avatarMessageItem" draggable="false" oncontextmenu="return false">
												<?php } ?>
												<!-- <div class="userNameContent">
													<div class="menuMessageItem">
														<?php if (intval($row['creator']) == $my_id_get) { ?>
														<img onclick="removeMessage(<?php echo(intval($chat_id)); ?>, <?php echo htmlspecialchars(intval($row['id'])); ?>);" class="itemMenuMessage" src="assets/icons/ic_remove_message.png" title="<?php echo($string_remove_message); ?>">
														<?php } ?>
													</div>
												</div> -->
												<div class="msContentItem <?php if (intval($row['creator']) != $my_id_get) { echo('otherContentItem'); } ?> <?php if (intval($row['creator']) == $my_id_get) { echo('iContentItem'); } ?>">
													<?php if ($row['type'] == 'message') { /*ПРОСТОЕ СООБЩЕНИЕ С ТЕКСТОМ И/ИЛИ ИЗОБРАЖЕНИЕМ*/ ?>
														<?php if ($row['message'] != '') { ?>
															<h2 class="messageItem <?php if (intval($row['creator']) != $my_id_get) { echo('otherMessageItem'); } ?> <?php if (intval($row['creator']) == $my_id_get) { echo('iMessageItem'); } ?>"><?php echo htmlspecialchars($row['message']); ?></h2>
														<?php } ?>
														<?php if ($row['image'] != '') { ?>
															<br>
															<img class="imageMessageItem" src="<?php echo htmlspecialchars($row['image']); ?>" draggable="false" oncontextmenu="return false">
														<?php } ?>
													<?php } ?>
													<h2 class="userNameMessageItem <?php if (intval($row['creator']) != $my_id_get) { echo('otherUserNameMessageItem'); } ?> <?php if (intval($row['creator']) == $my_id_get) { echo('iUserNameMessageItem'); } ?>"><?php echo htmlspecialchars($user_message_i['first_name']); ?> <?php echo htmlspecialchars($user_message_i['last_name']); ?> | <?php echo htmlspecialchars($row['date']); ?></h2>
												</div>
											</div>

										</div>
									</div>
								<?php
							}
						}
					}


					if ($type === 'sendMessage') {
						$mess = mysqli_real_escape_string($connect, $_POST['mess']);
						$device = $_SESSION['type_device'];
						//Проверям есть ли переменные на добавление
						if ($my_id_get === intval($user['id'])) {
							if (isset($_POST['mess']) && $_POST['mess'] != "" && $_POST['mess'] != " ") {
								$res = mysqli_query($connect, "INSERT INTO `user_messages` (`message`,`creator`,`device`,`type`,`chat_id`) VALUES ('$mess','$my_id_get','$device','message','$chat_id')");
							}
						}
					}




					if ($type === 'removeMessage') {
						$message_id = intval($_GET['message_id']);
						mysqli_query($connect ,"DELETE FROM `user_messages` WHERE `id` = '$message_id' AND `creator` = '$my_id_get'");
					}




				} else {

				}
			}
		}
	}
?>
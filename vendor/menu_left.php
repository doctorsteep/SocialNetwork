<?php
if ($user['banned'] == 0) {
	if (mysqli_num_rows($check_user) > 0) {
		if ($user['email'] == $email && $user['password'] == $password) {
			$m_id_check_m = intval($user['id']);
?>
<div class="leftMenu">
	<ul class="leftMenu">
		<li tooltip="<?php echo($string_my_account); ?>" onclick="window.location = 'profile.php?id=<?php echo(intval($user['id'])); ?>';" class="itemLeftMenu"><img class="leftMenu" src="assets/icons/ic_home_blue.png"><!-- <?php echo($string_my_account); ?> --></li>
		<li tooltip="<?php echo($string_title_home); ?>" onclick="window.location = 'home.php';" class="itemLeftMenu"><img class="leftMenu" src="assets/icons/ic_news_blue.png"><!-- <?php echo($string_title_home); ?> --></li>
		<li tooltip="<?php echo($string_messages); ?>" <?php if ($detect_device->isMobile()) { ?>onclick="window.location = 'chat.php';"<?php } else { ?>onclick="window.location = 'im.php';"<?php } ?> class="itemLeftMenu"><img class="leftMenu" src="assets/icons/ic_message_blue.png"><!-- <?php echo($string_messages); ?> --></li>
	</ul>
</div>
<?php }}} ?>
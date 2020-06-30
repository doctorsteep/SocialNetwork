<?php
	echo('<div style="display: none;" class="userMenu" id="userMenu"><ul class="userUl">');
	echo('<li onclick="window.location = \'profile.php?id=' . intval($user['id']) . '\';" class="userLi">' . $string_my_account . '</li>');
	echo('<center><hr class="li"></center>');
	echo('<li onclick="window.location = \'edit.php\';" class="userLi">' . $string_edit_account . '</li>');
	echo('<li onclick="window.location = \'settings.php\';" class="userLi">' . $string_settings . '</li>');
	if ($user['category'] == 'admin') {
		echo('<li onclick="window.location = \'admin\';" class="userLi">' . $string_admin_panel . '</li>');
	}
	echo('<center><hr class="li"></center>');
	echo('<li onclick="window.location = \'vendor/logout.php\';" class="userLi">' . $string_logout . '</li>');
	echo('</ul></div>');
?>
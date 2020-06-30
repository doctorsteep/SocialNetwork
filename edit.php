<?php
	session_start();
	include 'lang/language.php';
	include 'style/style.php';
	include 'vendor/connect.php';
	require_once "libs/Mobile_Detect.php";
	$detect_device = new Mobile_Detect;

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '') {
		header('location: ../');
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];

		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
		}
	}
?>

<!DOCTYPE html>
<html lang="<?php echo($string_type_lang); ?>">
	<head>
		<title><?php echo($string_edit_account_title); ?></title>
		<?php if ($detect_device->isMobile()) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default_m); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_edit_m); ?>">
		<?php } else { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_edit); ?>">
		<?php } ?>
		<link rel="shortcut icon" href="<?php echo($url_favicon_img); ?>" type="image/png">
		<meta charset="utf-8">
		<meta name="description" content="<?php echo($string_index_description) ?>">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<nav class="bar">
			<?php if (!$detect_device->isMobile()) { ?><img draggable="false" oncontextmenu="return false" src="<?php echo($url_logo_img); ?>" class="logo"><?php } ?>
			<?php  if (!$detect_device->isMobile()) { include 'vendor/search_friend.php'; } ?>
			<?php if ($detect_device->isMobile()) { ?><img src="assets/icons/ic_back_blue.png" draggable="false" oncontextmenu="return false" class="imgBackBar" onclick="history.back()"><?php } ?>
			<h2 class="title"><?php if ($detect_device->isMobile()) { ?><?php echo($string_edit_account_title_small); ?><?php } ?></h2>
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

		<?php
			if ($_SESSION['message_type'] != '' && $_SESSION['message'] != '') {
				echo('<p class="message ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</p>');
				unset($_SESSION['message_type']);
				unset($_SESSION['message']);
			}
		?>
		<?php if (!$detect_device->isMobile()) { include 'vendor/menu_left.php'; } ?>
		<?php
			if ($user['banned'] == 0) {
				if (mysqli_num_rows($check_user) > 0) {
					echo('<div class="editBigContent">');
					echo('<div class="editContent1">');
					echo('<form action="vendor/edit/default.php" method="POST" class="contentForm">');
					echo('<div class="divTitle" id="divDefault">');
					echo('<h2 class="titleContent">' . $string_edit_default . '</h2>');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_description_status . ':</label>
					<input class="login" type="description" name="description" placeholder="' . $string_description_status . '" value="' . $user['description'] . '">');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_first_name . ':</label>
					<input class="login" type="first_name" name="first_name" placeholder="' . $string_enter_first_name . '" value="' . $user['first_name'] . '">');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_last_name . ':</label>
					<input class="login" type="last_name" name="last_name" placeholder="' . $string_enter_last_name . '" value="' . $user['last_name'] . '">');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_select_sex . ':</label>'); ?>
					<select class="login" name="sex">
						<option value="m" class="login" <?php if ($user['sex'] == 'm') { echo('selected'); } ?>><?php echo($string_sex_man); ?></option>
						<option value="f" class="login" <?php if ($user['sex'] == 'f') { echo('selected'); } ?>><?php echo($string_sex_girl); ?></option>
					</select>
					<?php echo('</div>');

					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_you_happy_day. ':</label>'); 
					$date = date_create($user['happy']);?>
					<div>
						<select name="dd" class="login2">
							<option value="" class="login"><?php echo($string_date_day); ?></option>
							<option value="01" class="login" <?php if (date_format($date, "d") == '01') { echo('selected'); } ?>>1</option>
							<option value="02" class="login" <?php if (date_format($date, "d") == '02') { echo('selected'); } ?>>2</option>
							<option value="03" class="login" <?php if (date_format($date, "d") == '03') { echo('selected'); } ?>>3</option>
							<option value="04" class="login" <?php if (date_format($date, "d") == '04') { echo('selected'); } ?>>4</option>
							<option value="05" class="login" <?php if (date_format($date, "d") == '05') { echo('selected'); } ?>>5</option>
							<option value="06" class="login" <?php if (date_format($date, "d") == '06') { echo('selected'); } ?>>6</option>
							<option value="07" class="login" <?php if (date_format($date, "d") == '07') { echo('selected'); } ?>>7</option>
							<option value="08" class="login" <?php if (date_format($date, "d") == '08') { echo('selected'); } ?>>8</option>
							<option value="09" class="login" <?php if (date_format($date, "d") == '09') { echo('selected'); } ?>>9</option>
							<option value="10" class="login" <?php if (date_format($date, "d") == '10') { echo('selected'); } ?>>10</option>
							<option value="11" class="login" <?php if (date_format($date, "d") == '11') { echo('selected'); } ?>>11</option>
							<option value="12" class="login" <?php if (date_format($date, "d") == '12') { echo('selected'); } ?>>12</option>
							<option value="13" class="login" <?php if (date_format($date, "d") == '13') { echo('selected'); } ?>>13</option>
							<option value="14" class="login" <?php if (date_format($date, "d") == '14') { echo('selected'); } ?>>14</option>
							<option value="15" class="login" <?php if (date_format($date, "d") == '15') { echo('selected'); } ?>>15</option>
							<option value="16" class="login" <?php if (date_format($date, "d") == '16') { echo('selected'); } ?>>16</option>
							<option value="17" class="login" <?php if (date_format($date, "d") == '17') { echo('selected'); } ?>>17</option>
							<option value="18" class="login" <?php if (date_format($date, "d") == '18') { echo('selected'); } ?>>18</option>
							<option value="19" class="login" <?php if (date_format($date, "d") == '19') { echo('selected'); } ?>>19</option>
							<option value="20" class="login" <?php if (date_format($date, "d") == '20') { echo('selected'); } ?>>20</option>
							<option value="21" class="login" <?php if (date_format($date, "d") == '21') { echo('selected'); } ?>>21</option>
							<option value="22" class="login" <?php if (date_format($date, "d") == '22') { echo('selected'); } ?>>22</option>
							<option value="23" class="login" <?php if (date_format($date, "d") == '23') { echo('selected'); } ?>>23</option>
							<option value="24" class="login" <?php if (date_format($date, "d") == '24') { echo('selected'); } ?>>24</option>
							<option value="25" class="login" <?php if (date_format($date, "d") == '25') { echo('selected'); } ?>>25</option>
							<option value="26" class="login" <?php if (date_format($date, "d") == '26') { echo('selected'); } ?>>26</option>
							<option value="27" class="login" <?php if (date_format($date, "d") == '27') { echo('selected'); } ?>>27</option>
							<option value="28" class="login" <?php if (date_format($date, "d") == '28') { echo('selected'); } ?>>28</option>
							<option value="29" class="login" <?php if (date_format($date, "d") == '29') { echo('selected'); } ?>>29</option>
							<option value="30" class="login" <?php if (date_format($date, "d") == '30') { echo('selected'); } ?>>30</option>
							<option value="31" class="login" <?php if (date_format($date, "d") == '31') { echo('selected'); } ?>>31</option>
						</select>
						<select name="mm" class="login2">
							<option value="" class="login"><?php echo($string_date_month); ?></option>
							<option value="01" class="login" <?php if (date_format($date, "m") == '01') { echo('selected'); } ?>><?php echo($string_month_jan); ?></option>
							<option value="02" class="login" <?php if (date_format($date, "m") == '02') { echo('selected'); } ?>><?php echo($string_month_feb); ?></option>
							<option value="03" class="login" <?php if (date_format($date, "m") == '03') { echo('selected'); } ?>><?php echo($string_month_mar); ?></option>
							<option value="04" class="login" <?php if (date_format($date, "m") == '04') { echo('selected'); } ?>><?php echo($string_month_apr); ?></option>
							<option value="05" class="login" <?php if (date_format($date, "m") == '05') { echo('selected'); } ?>><?php echo($string_month_may); ?></option>
							<option value="06" class="login" <?php if (date_format($date, "m") == '06') { echo('selected'); } ?>><?php echo($string_month_jun); ?></option>
							<option value="07" class="login" <?php if (date_format($date, "m") == '07') { echo('selected'); } ?>><?php echo($string_month_jul); ?></option>
							<option value="08" class="login" <?php if (date_format($date, "m") == '08') { echo('selected'); } ?>><?php echo($string_month_aug); ?></option>
							<option value="09" class="login" <?php if (date_format($date, "m") == '09') { echo('selected'); } ?>><?php echo($string_month_sep); ?></option>
							<option value="10" class="login" <?php if (date_format($date, "m") == '10') { echo('selected'); } ?>><?php echo($string_month_oct); ?></option>
							<option value="11" class="login" <?php if (date_format($date, "m") == '11') { echo('selected'); } ?>><?php echo($string_month_nov); ?></option>
							<option value="12" class="login" <?php if (date_format($date, "m") == '12') { echo('selected'); } ?>><?php echo($string_month_dec); ?></option>
						</select>
						<select name="yy" class="login2" style="margin-top: 6px;">
							<option value=""><?php echo($string_date_year); ?></option>
							<?php for($i = $year_min; $i <= $year_max; $i++) { echo ('<option value="' . $i . '" class="login" '); ?> <?php if (date_format($date, "Y") == $i) { echo('selected'); } ?> <?php echo('>' . $i .'</option>'); ?> <?php } ?>
						</select>
					</div>
					<?php 
					echo('</div>');

					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_family_state . ':</label>'); ?>
					<select class="login" name="family_state">
						<option value="0" class="login" <?php if ($user['family_state'] == 0) { echo('selected'); } ?>><?php echo($string_family_state_none); ?></option>
						<?php if ($user['sex'] == 'm') { ?>
						<option value="1" class="login" <?php if ($user['family_state'] == 1) { echo('selected'); } ?>><?php echo($string_family_state_no_family_m); ?></option>
						<?php } ?>
						<?php if ($user['sex'] == 'f') { ?>
						<option value="1" class="login" <?php if ($user['family_state'] == 1) { echo('selected'); } ?>><?php echo($string_family_state_no_family_f); ?></option>
						<?php } ?>
						<?php if ($user['sex'] == 'm') { ?>
						<option value="2" class="login" <?php if ($user['family_state'] == 2) { echo('selected'); } ?>><?php echo($string_family_state_family_m); ?></option>
						<?php } ?>
						<?php if ($user['sex'] == 'f') { ?>
						<option value="2" class="login" <?php if ($user['family_state'] == 2) { echo('selected'); } ?>><?php echo($string_family_state_family_f) ; ?></option>
						<?php } ?>
						<option value="3" class="login" <?php if ($user['family_state'] == 3) { echo('selected'); } ?>><?php echo($string_family_state_searched); ?></option>
						<?php if ($user['sex'] == 'm') { ?>
						<option value="4" class="login" <?php if ($user['family_state'] == 4) { echo('selected'); } ?>><?php echo($string_family_state_pom_m); ?></option>
						<?php } ?>
						<?php if ($user['sex'] == 'f') { ?>
						<option value="4" class="login" <?php if ($user['family_state'] == 4) { echo('selected'); } ?>><?php echo($string_family_state_pom_f); ?></option>
						<?php } ?>
						<option value="5" class="login" <?php if ($user['family_state'] == 5) { echo('selected'); } ?>><?php echo($string_family_state_country_brack); ?></option>
						<?php if ($user['sex'] == 'm') { ?>
						<option value="6" class="login" <?php if ($user['family_state'] == 6) { echo('selected'); } ?>><?php echo($string_family_state_loved_m); ?></option>
						<?php } ?>
						<?php if ($user['sex'] == 'f') { ?>
						<option value="6" class="login" <?php if ($user['family_state'] == 6) { echo('selected'); } ?>><?php echo($string_family_state_loved_f); ?></option>
						<?php } ?>
						<option value="7" class="login" <?php if ($user['family_state'] == 7) { echo('selected'); } ?>><?php echo($string_family_state_not_loved); ?></option>
						<option value="8" class="login" <?php if ($user['family_state'] == 8) { echo('selected'); } ?>><?php echo($string_family_state_active_searching); ?></option>
				    </select>
					<?php echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_login . ':</label>
					<input class="login" type="login" name="login" placeholder="' . $string_enter_login . '" value="' . $user['login'] . '" disabled>');
					echo('</div>');
					echo('<hr class="end"><button type="submit" class="save">' . $string_save . '</button>');
					echo('</form>');








					echo('<form action="vendor/edit/contacts.php" method="POST" class="contentForm">');
					echo('<div class="divTitle" id="divContacts">');
					echo('<h2 class="titleContent">' . $string_edit_contacts . '</h2>');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_contact_site . ':</label>
					<input class="login" type="description" name="site" placeholder="https://site.com" value="' . $user['site'] . '">');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_contact_vk . ':</label>
					<input class="login" type="description" name="vk" placeholder="username" value="' . $user['vk'] . '">');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_contact_instagram . ':</label>
					<input class="login" type="description" name="instagram" placeholder="username" value="' . $user['instagram'] . '">');
					echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_contact_phone . ':</label>
					<input class="login" type="number" name="phone" placeholder="375290000000" value="' . $user['phone'] . '">');
					echo('</div>');
					
					echo('<hr class="end"><button type="submit" class="save">' . $string_save . '</button>');
					echo('</form>');






					echo('<form action="vendor/edit/static_info.php" method="POST" class="contentForm">');
					echo('<div class="divTitle" id="divStaticInfo">');
					echo('<h2 class="titleContent">' . $string_edit_static_info . '</h2>');
					echo('</div>');
					echo('<div class="contentItem">');?>
					<label class="title"><?php echo($string_select_country); ?>:</label>
					<select class="login" name="country">
						<option value="none" class="login" <?php if ($user['country'] == 'none') { echo('selected');} ?>><?php echo($string_country_no); ?></option>
						<option value="by" class="login" <?php if ($user['country'] == 'by') { echo('selected');} ?>><?php echo($string_country_by); ?></option>
					</select>
					<?php echo('</div>');
					echo('<div class="contentItem">');?>
					<label class="title"><?php echo($string_select_sity); ?>:</label>
					<select class="login" name="sity">
						<option value="by0" class="login" <?php if ($user['sity'] == 'by0') { echo('selected');} ?>><?php echo($string_sity_no); ?></option>
						<option value="by1" class="login" <?php if ($user['sity'] == 'by1') { echo('selected');} ?>><?php echo($string_sity_by_1); ?></option>
						<option value="by2" class="login" <?php if ($user['sity'] == 'by2') { echo('selected');} ?>><?php echo($string_sity_by_2); ?></option>
						<option value="by3" class="login" <?php if ($user['sity'] == 'by3') { echo('selected');} ?>><?php echo($string_sity_by_3); ?></option>
						<option value="by4" class="login" <?php if ($user['sity'] == 'by4') { echo('selected');} ?>><?php echo($string_sity_by_4); ?></option>
						<option value="by5" class="login" <?php if ($user['sity'] == 'by5') { echo('selected');} ?>><?php echo($string_sity_by_5); ?></option>
						<option value="by6" class="login" <?php if ($user['sity'] == 'by6') { echo('selected');} ?>><?php echo($string_sity_by_6); ?></option>
						<option value="by7" class="login" <?php if ($user['sity'] == 'by7') { echo('selected');} ?>><?php echo($string_sity_by_7); ?></option>
						<option value="by8" class="login" <?php if ($user['sity'] == 'by8') { echo('selected');} ?>><?php echo($string_sity_by_8); ?></option>
						<option value="by9" class="login" <?php if ($user['sity'] == 'by9') { echo('selected');} ?>><?php echo($string_sity_by_9); ?></option>
						<option value="by10" class="login" <?php if ($user['sity'] == 'by10') { echo('selected');} ?>><?php echo($string_sity_by_10); ?></option>
						<option value="by11" class="login" <?php if ($user['sity'] == 'by11') { echo('selected');} ?>><?php echo($string_sity_by_11); ?></option>
						<option value="by12" class="login" <?php if ($user['sity'] == 'by12') { echo('selected');} ?>><?php echo($string_sity_by_12); ?></option>
						<option value="by13" class="login" <?php if ($user['sity'] == 'by13') { echo('selected');} ?>><?php echo($string_sity_by_13); ?></option>
						<option value="by14" class="login" <?php if ($user['sity'] == 'by14') { echo('selected');} ?>><?php echo($string_sity_by_14); ?></option>
						<option value="by15" class="login" <?php if ($user['sity'] == 'by15') { echo('selected');} ?>><?php echo($string_sity_by_15); ?></option>
						<option value="by16" class="login" <?php if ($user['sity'] == 'by16') { echo('selected');} ?>><?php echo($string_sity_by_16); ?></option>
						<option value="by17" class="login" <?php if ($user['sity'] == 'by17') { echo('selected');} ?>><?php echo($string_sity_by_17); ?></option>
						<option value="by18" class="login" <?php if ($user['sity'] == 'by18') { echo('selected');} ?>><?php echo($string_sity_by_18); ?></option>
						<option value="by19" class="login" <?php if ($user['sity'] == 'by19') { echo('selected');} ?>><?php echo($string_sity_by_19); ?></option>
						<option value="by20" class="login" <?php if ($user['sity'] == 'by20') { echo('selected');} ?>><?php echo($string_sity_by_20); ?></option>
						<option value="by21" class="login" <?php if ($user['sity'] == 'by21') { echo('selected');} ?>><?php echo($string_sity_by_21); ?></option>
						<option value="by22" class="login" <?php if ($user['sity'] == 'by22') { echo('selected');} ?>><?php echo($string_sity_by_22); ?></option>
						
						<!-- <option class="divider" disabled>&nbsp;</option> -->
					</select>
					<?php echo('</div>');
					echo('<div class="contentItem">');
					echo('<label class="title">' . $string_about . ':</label>
					<textarea class="login" type="text" name="about" placeholder="' . $string_about . '" value="' . $user['about'] . '">' . $user['about'] . '</textarea>');
					echo('</div>');
					
					echo('<hr class="end"><button type="submit" class="save">' . $string_save . '</button>');
					echo('</form>');
					echo('</div>');

					echo('<div class="editContent2">');

					echo('</div>');
					echo('</div>');
				} else {
					echo('<h2 class="titleBanned">' . $string_signin_title . '</h2>');
					echo('<h3 class="messageBanned">' . $string_signin_description . '</h3>');
					echo('<hr class="banned">');
					echo('<div class="divBanned"><a href="./"><button>' . $string_signin .'</button></a></div>');
				}
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
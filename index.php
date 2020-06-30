<?php
	session_start();
	include 'vendor/connect.php';
	include 'lang/language.php';
	include 'style/style.php';
	require_once "libs/Mobile_Detect.php";
	$detect_device = new Mobile_Detect;

	if ($_SESSION['user_email'] != '' && $_SESSION['user_password'] != '') {
		header('location: home.php');
	}
?>
<!DOCTYPE html>
<html lang="<?php echo($string_type_lang); ?>">
	<head>
		<title><?php echo($string_title_index); ?></title>
		<?php if ($detect_device->isMobile()) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default_m); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_index_m); ?>">
		<?php } else { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_index); ?>">
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
			<h2 class="title"><?php echo($title_nav); ?></h2>
		</nav>
		<?php } ?>

		<?php
			if ($_SESSION['message_type'] != '' && $_SESSION['message'] != '') {
				echo('<p class="message ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</p>');
				unset($_SESSION['message_type']);
				unset($_SESSION['message']);
			}
		?>

		<div class="bigContent">
			<?php if (!$detect_device->isMobile()) { ?>
				<div class="contentInfo">
					<div class="contentInfoData">
						<center>
							<img src="assets/icons/art_belarus.png" class="belarus">
							<h2 class="titleBelarus"><?php echo($string_title_index); ?></h2>
							<h2 class="messBelarus"><?php echo($string_index_description); ?></h2>
							<hr style="margin-top: 30px;">
							<h2 class="mal"><?php $all_users = mysqli_query($connect, "SELECT * FROM `users` WHERE `vemail` = 1"); echo($string_all_users); ?> <strong class="mal"><?php echo(mysqli_num_rows($all_users)); ?></strong> <?php echo($string_all_users_pip); ?></h2>
						</center>
					</div>
				</div>
			<?php } ?>
			<?php if ($detect_device->isMobile()) { echo('<center>'); echo('<img src="assets/icons/favicon_v2.png" class="favicon">'); } ?>
			<div class="content">
				<form action="vendor/signin.php" method="POST" class="content">
					<label class="title"><?php echo($string_email); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="email" name="email" placeholder="<?php echo($string_enter_email); ?>">
					<label class="title"><?php echo($string_password); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="password" name="password" placeholder="<?php echo($string_enter_password); ?>">

					<button type="submit" class="signin"><?php echo($string_signin); ?></button>
				</form>
			</div>
			<div class="content2">
				<form action="vendor/signup.php" method="POST" class="content">
					<label class="title"><?php echo($string_email); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="email" name="email" placeholder="<?php echo($string_enter_email); ?>">
					<label class="title"><?php echo($string_last_name); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="last_name" name="last_name" placeholder="<?php echo($string_enter_last_name); ?>">
					<label class="title"><?php echo($string_first_name); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="first_name" name="first_name" placeholder="<?php echo($string_enter_first_name); ?>">
					<label class="title"><?php echo($string_select_sex); ?></label>
					<select class="login" name="sex">
				    	<option value="m" class="login"><?php echo($string_sex_man); ?></option>
				    	<option value="f" class="login"><?php echo($string_sex_girl); ?></option>
				    </select>
				    <label class="title"><?php echo($string_you_happy_day); ?></label>
					<div>
						<select name="dd" class="login2">
							<option value="" class="login"><?php echo($string_date_day); ?></option>
							<option value="01" class="login">1</option>
							<option value="02" class="login">2</option>
							<option value="03" class="login">3</option>
							<option value="04" class="login">4</option>
							<option value="05" class="login">5</option>
							<option value="06" class="login">6</option>
							<option value="07" class="login">7</option>
							<option value="08" class="login">8</option>
							<option value="09" class="login">9</option>
							<option value="10" class="login">10</option>
							<option value="11" class="login">11</option>
							<option value="12" class="login">12</option>
							<option value="13" class="login">13</option>
							<option value="14" class="login">14</option>
							<option value="15" class="login">15</option>
							<option value="16" class="login">16</option>
							<option value="17" class="login">17</option>
							<option value="18" class="login">18</option>
							<option value="19" class="login">19</option>
							<option value="20" class="login">20</option>
							<option value="21" class="login">21</option>
							<option value="22" class="login">22</option>
							<option value="23" class="login">23</option>
							<option value="24" class="login">24</option>
							<option value="25" class="login">25</option>
							<option value="26" class="login">26</option>
							<option value="27" class="login">27</option>
							<option value="28" class="login">28</option>
							<option value="29" class="login">29</option>
							<option value="30" class="login">30</option>
							<option value="31" class="login">31</option>
						</select>
						<select name="mm" class="login2">
							<option value="" class="login"><?php echo($string_date_month); ?></option>
							<option value="01" class="login"><?php echo($string_month_jan); ?></option>
							<option value="02" class="login"><?php echo($string_month_feb); ?></option>
							<option value="03" class="login"><?php echo($string_month_mar); ?></option>
							<option value="04" class="login"><?php echo($string_month_apr); ?></option>
							<option value="05" class="login"><?php echo($string_month_may); ?></option>
							<option value="06" class="login"><?php echo($string_month_jun); ?></option>
							<option value="07" class="login"><?php echo($string_month_jul); ?></option>
							<option value="08" class="login"><?php echo($string_month_aug); ?></option>
							<option value="09" class="login"><?php echo($string_month_sep); ?></option>
							<option value="10" class="login"><?php echo($string_month_oct); ?></option>
							<option value="11" class="login"><?php echo($string_month_nov); ?></option>
							<option value="12" class="login"><?php echo($string_month_dec); ?></option>
						</select>
						<select name="yy" class="login2" style="margin-top: 6px;">
							<option value=""><?php echo($string_date_year); ?></option>
							<?php for($i = $year_min; $i <= $year_max; $i++) { echo "<option value='$i' class=\"login\">" . $i . "</option>"; } ?>
						</select>
					</div>

					<br>

					<label class="title"><?php echo($string_password); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="password" name="password" placeholder="<?php echo($string_enter_password); ?>">
					<label class="title"><?php echo($string_confirm_password); ?></label>
					<input <?php if ($detect_device->isMobile()) { echo('autocomplete="off"'); } ?> class="login" type="password" name="password_confirm" placeholder="<?php echo($string_enter_confirm_password); ?>">

					<h4 class="info"><?php echo($string_description_signup); ?></h4>

					<button type="submit" class="signup"><?php echo($string_registration); ?></button>
				</form>
			</div>

			<?php if ($detect_device->isMobile()) { echo('</center>'); } ?>
		</div>

		<?php if (!$detect_device->isMobile()) { ?>
		<hr>

		<div class="hover">
			<h2 class="hoverInfo"><?php echo($string_hover_info); ?></h2>
		</div>
		<?php } ?>
	</body>
</html>
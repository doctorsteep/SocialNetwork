<?php
	if ($user['banned'] == 0) {
		if (mysqli_num_rows($check_user) > 0) {
			if ($user_view['email'] == $email && $user_view['password'] == $password) {
?>
<div class="alert" id="alertUpdateStatus">
	<div class="alertBackground">
		<nav class="alertNav">
			<h2 class="alertTitle"><?php echo($string_description_status); ?></h2>
			<h2 class="alertTitleClose" id="closeAlertUpdateStatus"><?php echo($string_close); ?></h2>
		</nav>
		<div class="alertContent">
			<form class="avatarUpload" action="vendor/edit/status.php" method="POST" enctype="multipart/form-data">
				<div style="display: flex; justify-content: center; align-items: center;">
					<input class="login" type="text" name="status" style="margin-left: 10px; margin-right: 10px; width: 100%;" value="<?php echo($user['description']); ?>">
					<button type="sumbit" style="margin-right: 10px;"><?php echo($string_save); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
			}
		}
	}
?>

<?php
	if ($user['banned'] == 0) {
		if (mysqli_num_rows($check_user) > 0) {
			if ($user_view['email'] == $email && $user_view['password'] == $password) {
				echo('<script type="text/javascript" src="js/alert_update_status.js?v=2"></script>');
			}
		}
	}
?>
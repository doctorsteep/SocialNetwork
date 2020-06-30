<?php
	if ($user['banned'] == 0) {
		if (mysqli_num_rows($check_user) > 0) {
			if ($user_view['email'] == $email && $user_view['password'] == $password) {
?>
<div class="alert" id="alertUpdatePhoto">
	<div class="alertBackground">
		<nav class="alertNav">
			<h2 class="alertTitle"><?php echo($string_upload_avatar); ?></h2>
			<h2 class="alertTitleClose" id="closeAlertUpdatePhoto"><?php echo($string_close); ?></h2>
		</nav>
		<div class="alertContent">
			<form class="avatarUpload" action="vendor/edit/photo.php?t=upload" method="POST" enctype="multipart/form-data">
				<div style="display: flex; justify-content: center; align-items: center;">
					<input type="file" name="avatar" accept=".png, .jpg, .jpeg">
					<button type="sumbit"><?php echo($string_upload); ?></button>
				</div>
				<div style="margin-top: 20px;">
					<h2 class="alertMessage"><?php echo($string_upload_avatar_description); ?></h2>
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
				echo('<script type="text/javascript" src="js/alert_update_photo.js?v=2"></script>');
			}
		}
	}
?>
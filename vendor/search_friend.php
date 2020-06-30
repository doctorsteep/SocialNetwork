<?php
	if ($user['banned'] == 0) {
		if (mysqli_num_rows($check_user) > 0) {
			if ($user['email'] == $email && $user['password'] == $password) {
				?>
	<div class="searchDiv">
		<input type="search" class="searchNav" autocomplete="off" oninput="myFunction()" id="search" placeholder="<?php echo($string_hint_search); ?>">
		<?php
			if ($user['banned'] == 0) {
				if (mysqli_num_rows($check_user) > 0) {
					if ($user['email'] == $email && $user['password'] == $password) {
						?>
							<div class="friendsSearch">
								<?php 
									$my_id_find = intval($user['id']);
									$query_subscribed_my = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$my_id_find' LIMIT 10");
									$query_subscribers_my = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend2` = '$my_id_find' LIMIT 10");
									if (mysqli_num_rows($query_subscribed_my) > 0 || mysqli_num_rows($query_subscribers_my) > 0) {
										echo('<div class="listMyFriendFind" id="listMyFriendFind">');
										echo('<h2 class="titleFind">' . $string_my_subscribed . '</h2>');
										while($row = mysqli_fetch_assoc($query_subscribed_my)) {
											$id_finds = intval($row['friend2']);
											$check_user_finds = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_finds'");
											if (mysqli_num_rows($check_user_finds) > 0) {
												$user_item_find = mysqli_fetch_assoc($check_user_finds);
												?>
												<div-find title="<?php echo($user_item_find['first_name']); ?> <?php echo($user_item_find['last_name']); ?>" class="itemListFind" id="itemListFind" onclick="window.location = 'profile.php?id=<?php echo(intval($user_item_find['id'])); ?>'">
													<?php if ($user_item_find['avatar'] == '') { ?>
														<img class="avatarUserFind" src="<?php echo($url_no_avatar); ?>" draggable="false" oncontextmenu="return false">
													<?php } else { ?>
														<img class="avatarUserFind" src="<?php echo htmlspecialchars($user_item_find['avatar']); ?>" draggable="false" oncontextmenu="return false">
													<?php } ?>
													<name class="userFindName"><?php echo htmlspecialchars($user_item_find['first_name']); ?> <?php echo htmlspecialchars($user_item_find['last_name']); ?></name>
										    	</div-find>
										    	<?php
											}
										}
										echo('<h2 class="titleFind">' . $string_my_subscribers . '</h2>');
										while($row2 = mysqli_fetch_assoc($query_subscribers_my)) {
											$id_finds_2 = intval($row2['friend1']);
											$check_user_finds_2 = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_finds_2'");
											if (mysqli_num_rows($check_user_finds_2) > 0) {
												$user_item_find_2 = mysqli_fetch_assoc($check_user_finds_2);
												?>
												<div-find title="<?php echo($user_item_find_2['first_name']); ?> <?php echo($user_item_find_2['last_name']); ?>" class="itemListFind" id="itemListFind" onclick="window.location = 'profile.php?id=<?php echo(intval($user_item_find_2['id'])); ?>'">
													<?php if ($user_item_find_2['avatar'] == '') { ?>
														<img class="avatarUserFind" src="<?php echo($url_no_avatar); ?>" draggable="false" oncontextmenu="return false">
													<?php } else { ?>
														<img class="avatarUserFind" src="<?php echo htmlspecialchars($user_item_find_2['avatar']); ?>" draggable="false" oncontextmenu="return false">
													<?php } ?>
													<name class="userFindName"><?php echo htmlspecialchars($user_item_find_2['first_name']); ?> <?php echo htmlspecialchars($user_item_find_2['last_name']); ?></name>
										    	</div-find>
										    	<?php
											}
										}
										echo('</div>');
									}
								?>
								<button class="searchInput"><?php echo($string_go_to_search); ?></button>
							</div>

							<script type="text/javascript">
								function myFunction() {
									  	var input, filter, ol, li, a, i;
									  	input = document.getElementById("search");
									  	filter = input.value.toUpperCase();
									  	ol = document.getElementById("listMyFriendFind");
									  	li = ol.getElementsByTagName("div-find");
									  	for (i = 0; i < li.length; i++) {
									    	a = li[i].getElementsByTagName("name")[0];
									    	if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
									      		li[i].style.display = "table-column";
									    	} else {
									      		li[i].style.display = "none";
									    	}
									  	}
									}
							</script>


						<?php
					}
				}
			}
		?>
	</div>
	
	<?php
			}
		}
	}
?>
<?php
$type = $_GET['t'];

if ($_SESSION['user_email'] != '' && $_SESSION['user_password'] != '') {
	$check_user_p = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
	if (mysqli_num_rows($check_user_p) > 0) {
		$m_user = mysqli_fetch_assoc($check_user_p);
		$my_id = intval($m_user['id']);
		if ($m_user['email'] == $email && $m_user['password'] == $password) {
			// if ($type == 'load') {
				$results_posts = array();
				$results_posts[] = $my_id;
				$results_posts[] = 0;

				$sql_result_subscribed = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$my_id'");
				while($row = mysqli_fetch_assoc($sql_result_subscribed)) {
				   $results_posts[] = intval($row['friend2']);
				}
				?>
				<?php
				$sql_result_posts = mysqli_query($connect, "SELECT * FROM `user_posts` WHERE `publishing` IN('" . implode("','", $results_posts) . "') ORDER BY date DESC");
				while($row_users_posts = mysqli_fetch_assoc($sql_result_posts)) { 
					$creator = intval($row_users_posts['publishing']);
					$creator_post = intval($row_users_posts['creator']);
					$check_user_post = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$creator'");
					$check_user_creator_post = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$creator_post'");
					if (mysqli_num_rows($check_user_post) > 0) {
						$user_post = mysqli_fetch_assoc($check_user_post);
						$user_creator_post = mysqli_fetch_assoc($check_user_creator_post);
						?>
							<div class="postItem">
								<div class="userPostItem">
									<?php
										if ($user_post['avatar'] == '') {
									?>
											<img draggable="false" oncontextmenu="return false" onclick="window.location = 'profile.php?id=<?php echo(intval($user_post['id'])); ?>'" class="avatarUserPost" src="<?php echo($url_no_avatar); ?>">
									<?php
										} else {
									?>
											<img draggable="false" oncontextmenu="return false" onclick="window.location = 'profile.php?id=<?php echo(intval($user_post['id'])); ?>'" class="avatarUserPost" src="<?php echo($user_post['avatar']); ?>">
									<?php
										}
									?>
									<div class="nameUserPostItem">
										<div class="divPostUserName">
											<h2 class="postUserName"><?php echo($user_post['first_name'] . ' ' . $user_post['last_name']); ?><?php if ($user_post['verification'] == 1) { echo('<img draggable="false" oncontextmenu="return false" class="imgVerificationPost" src="' . $url_verification_img . '">'); } ?></h2>
											<div class="dataPostItem">
												
											</div>
											<?php if ($row_users_posts['type'] != 'ads') { ?>
											<div class="tooltipMenu menu_post">
												<i class="menuPost"><img class="menuPost" src="assets/icons/ic_menu_post.png"></i>
												<span class="tooltipTextMenu">
													<ul class="listMenuPost">
														<?php if (intval($row_users_posts['publishing']) == $my_id) { ?>
														<li onclick="window.location = 'vendor/user_posts.php?t=remove&post_id=<?php echo(intval($row_users_posts['id'])); ?>'" class="itemMenuPost"><?php echo($string_delete_post); ?></li>
														<?php } ?>
														<?php if (intval($row_users_posts['publishing']) != $my_id) { ?>
														<li onclick="window.location = 'vendor/user_posts.php?t=repost&post_id=<?php echo(intval($row_users_posts['id'])); ?>'" class="itemMenuPost"><?php echo($string_repost); ?></li>
														<?php } ?>
													</ul>
												</span>
											</div>
											<?php } ?>
										</div>
										<div class="divPostDate">
											<h2 class="postDate"><?php echo($row_users_posts['date']); ?></h2>
											<img class="postDevice" draggable="false" title="<?php if ($row_users_posts['device'] == 'pc') { echo($string_public_pс); } if ($row_users_posts['device'] == 'phone') { echo($string_public_phone); } ?>" oncontextmenu="return false" src="<?php echo('assets/icons/ic_' . $row_users_posts['device'] . '.png'); ?>">
										</div>
									</div>
								</div>
								<div class="postItemContent">
									<?php if ($row_users_posts['message'] != '') { ?>
										<h2 class="postMessage"><?php echo htmlspecialchars($row_users_posts['message']); ?></h2>
									<?php } ?>
									<?php if ($row_users_posts['image'] != '') { ?>
										<div class="imgPostItem">
											<img <?php if ($row_users_posts['message'] != '') { echo('style="margin-top: 14px;"'); }?> draggable="false" oncontextmenu="return false" class="imgPostMessage" src="<?php echo strip_tags($row_users_posts['image']); ?>">
										</div>
									<?php } ?>
								</div>
								<div class="typePostItems">
									<?php if ($row_users_posts['repost'] == 1) { ?> <h2 class="postUserRepost"><?php echo($user_post['first_name'] . ', '); if ($user_post['sex'] == 'f') { echo($string_repost_f); } else { echo($string_repost_m); } echo(' <a href="profile.php?id=' . intval($user_creator_post['id']) . '">' . $nc->q($user_creator_post['first_name'], 1) . '</a>'); ?></h2> <?php } ?>
									<?php if ($row_users_posts['type'] == 'ads') { ?> <h2 class="postUserRepost"><?php echo($string_message_post_ads); ?></h2> <?php } ?>
								</div>
							</div>
						<?php 
					}
				}
			// }
		}
	}
} ?>
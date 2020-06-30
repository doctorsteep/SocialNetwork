<?php
	session_start();
	include 'lang/language.php';
	include 'style/style.php';
	include 'vendor/connect.php';
	require 'vendor/NCLNameCaseRu.php';
	require_once "libs/Mobile_Detect.php";
	$detect_device = new Mobile_Detect;

	$user_id = intval($_GET['id']);
	$nc = new NCLNameCaseRu();

	if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '') {
		
	} else {
		$email = $_SESSION['user_email'];
		$password = $_SESSION['user_password'];
-
		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);
			$my_id = intval($user['id']);

			$check_user_subs = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$my_id'");
			if (mysqli_num_rows($check_user_subs) > 0) {
				$user_subs = mysqli_fetch_assoc($check_user_subs);
			}
		}
	}

	$check_user_view = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");
	if (mysqli_num_rows($check_user_view) > 0) {
		$user_view = mysqli_fetch_assoc($check_user_view);
		$_SESSION['user_view_id'] = $user_id;

		$check_user_subs_view = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend2` = '$user_id'");
		if (mysqli_num_rows($check_user_subs_view) > 0) {
			$user_subs_view = mysqli_fetch_assoc($check_user_subs_view);
		}
	}

	function getCountry($country_num) {
		include 'lang/language.php';
		$result = '';
		switch ($country_num) {
			case 'none': $result = $string_country_no; break;
			case 'by': $result = $string_country_by; break;
		}
		return $result;
	}

	function getSity($sity_id) {
		include 'lang/language.php';
		$result = '';
		switch ($sity_id) {
			case 'by0': $result = ''; break;
			case 'by1': $result = $string_sity_by_1; break;
			case 'by2': $result = $string_sity_by_2; break;
			case 'by3': $result = $string_sity_by_3; break;
			case 'by4': $result = $string_sity_by_4; break;
			case 'by5': $result = $string_sity_by_5; break;
			case 'by6': $result = $string_sity_by_6; break;
			case 'by7': $result = $string_sity_by_7; break;
			case 'by8': $result = $string_sity_by_8; break;
			case 'by9': $result = $string_sity_by_9; break;
			case 'by10': $result = $string_sity_by_10; break;
			case 'by11': $result = $string_sity_by_11; break;
			case 'by12': $result = $string_sity_by_12; break;
			case 'by13': $result = $string_sity_by_13; break;
			case 'by14': $result = $string_sity_by_14; break;
			case 'by15': $result = $string_sity_by_15; break;
			case 'by16': $result = $string_sity_by_16; break;
			case 'by17': $result = $string_sity_by_17; break;
			case 'by18': $result = $string_sity_by_18; break;
			case 'by19': $result = $string_sity_by_19; break;
			case 'by20': $result = $string_sity_by_20; break;
			case 'by21': $result = $string_sity_by_21; break;
			case 'by22': $result = $string_sity_by_22; break;
		}
		return $result;
	}

?>

<!DOCTYPE html>
<html lang="<?php echo($string_type_lang); ?>">
	<head>
		<?php
			if (mysqli_num_rows($check_user_view) > 0) {
				echo('<script src="js/cross_js.js?v=2"></script>');
				echo('<title>' . $user_view['first_name'] . ' ' . $user_view['last_name'] . '</title>');
				echo('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>');
				echo('<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>');
			} else {
				echo('<title>' . $string_no_user . '</title>');
			}
		?>
		<?php if ($detect_device->isMobile()) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default_m); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_profile_m); ?>">
		<?php } else { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo($style_default); ?>">
			<link rel="stylesheet" type="text/css" href="<?php echo($style_profile); ?>">
		<?php } ?>
		<link rel="shortcut icon" href="<?php echo($url_favicon_img); ?>" type="image/png">
		<meta charset="utf-8">
		<meta name="description" content="<?php echo($string_index_description) ?>">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<!-- <script type="text/javascript">
			google.load("jquery", "1.3.2");
			google.load("jqueryui", "1.7.2");
		</script> -->
		<nav class="bar">
			<?php if (!$detect_device->isMobile()) { ?><img draggable="false" oncontextmenu="return false" src="<?php echo($url_logo_img); ?>" class="logo"><?php } ?>
			<?php if (!$detect_device->isMobile()) { include 'vendor/search_friend.php'; } ?>
			<?php if ($detect_device->isMobile()) { ?><img src="assets/icons/ic_back_blue.png" draggable="false" oncontextmenu="return false" class="imgBackBar" onclick="history.back()"><?php } ?>
			<h2 class="title"><?php if ($detect_device->isMobile()) { ?><?php echo(htmlspecialchars($user_view['first_name']) . ' ' . htmlspecialchars($user_view['last_name'])); ?><?php } ?></h2>
			<?php
				if ($_SESSION['user_email'] === '' && $_SESSION['user_password'] === '') {
					echo('<a href="./"><button class="signin" style="margin-right: 10px;">' . $string_signin . '</button></a>');
				} else {
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
				}
			?>
		</nav>



		


		<?php
			// onerror="this.onerror=null; this.src='image.png'"






			// if ($user['banned'] == 0) {

			// } else {
			// 	echo('<h2 class="titleBanned">' . $string_banned . '</h2>');
			// 	echo('<h3 class="messageBanned">' . $string_banned_description . '</h3>');
			// 	echo('<hr class="banned">');
			// 	echo('<div class="divBanned"><a href="vendor/logout.php"><button>' . $string_logout .'</button></a></div>');
			// }
		?>
		<?php if (!$detect_device->isMobile()) { include 'vendor/menu_left.php'; } ?>
		<?php

			if (mysqli_num_rows($check_user_view) > 0) {
				echo('<div class="userBigContent">');
				if (!$detect_device->isMobile()) { echo('<div class="contentAll">');
				echo('<div class="contentUser">');
				if ($user_view['banned'] == 0) {
					if ($user_view['avatar'] == '') {
						echo('<img draggable="false" oncontextmenu="return false" class="avatarUser" src="' . $url_no_avatar . '">');
					} else {
						echo('<img draggable="false" oncontextmenu="return false" class="avatarUser" src="' . $user_view['avatar'] . '">');
					}
				} else {
					echo('<img draggable="false" oncontextmenu="return false" class="avatarUser" src="' . $url_no_avatar . '">');
				}
				if ($user_view['email'] == $email && $user_view['password'] == $password) {
					if ($user_view['banned'] == 0) {
						echo('<ul class="updatePhoto">');
						echo('<li class="itemUpdatePhoto" id="liUpdatePhoto">' . $string_upload_avatar . '</li>');
						if ($user_view['avatar'] != '') {
							echo('<li onclick="window.location = \'vendor/edit/photo.php?t=remove\';" class="itemUpdatePhoto">' . $string_delete_avatar . '</li>');
						}
						echo('</ul>');
						echo('<button class="edit" onclick="window.location = \'edit.php\';">' . $string_edit_account . '</button>');
					}
				}
				if (mysqli_num_rows($check_user) > 0) {
					if (intval($user['id']) != intval($user_view['id'])) {
						if ($user_view['banned'] == 0) {
							?><button class="subscribe" id="subBtn" onclick="sendSub(<?php echo htmlspecialchars(intval($user_view['id'])); ?>)"><?php echo($string_user_subscribe); ?></button>
							<script type="text/javascript" src="js/subs_manager.js?v=4"></script><?php
							echo('<script type="text/javascript">checkSub(' . intval($user_view['id']) . ');</script>');
						}
					}
				}
				if ($user_view['banned'] == 0) {
					if (intval($user_view['id']) != intval($user['id'])) {
						echo('<button class="write_message" onclick="window.location = \'vendor/new_chat.php?id_user=' . intval($user_view['id']) . '\';">' . $string_write_message . '</button>');
					}
				}

					
				echo('</div>');


				$query_subscribers = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend2` = '$user_id' LIMIT 9");
				$query_subscribers_no_limit = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend2` = '$user_id'");
				if (mysqli_num_rows($query_subscribers) > 0) {
					if ($email != '' && $password != '') {
						if ($user_view['banned'] == 0) {
							echo('<div class="contentUser">');
							if ($user_view['email'] === $email && $user_view['password'] === $password) {
								echo('<div class="divTitleContent"><h2 class="textTitleContent">' . $string_my_subscribers . '<h2 class="textSubTitleContent">' . mysqli_num_rows($query_subscribers_no_limit) . '</h2></h2></div>');
							} else {
								echo('<div class="divTitleContent"><h2 class="textTitleContent">' . $string_other_subscribers . ' ' . $nc->q($user_view['first_name'], 1) . '<h2 class="textSubTitleContent">' . mysqli_num_rows($query_subscribers_no_limit) . '</h2></h2></div>');
							}

							echo('<div class="divListSubscribers">');
							while($row = mysqli_fetch_assoc($query_subscribers)) {
								$id_subscriber = intval($row['friend1']);
								$check_user_subscriber = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_subscriber'");
								if (mysqli_num_rows($check_user_subscriber) > 0) {
									$user_item_subscriber = mysqli_fetch_assoc($check_user_subscriber);
									?>
									<div title="<?php echo htmlspecialchars($user_item_subscriber['first_name']); ?> <?php echo htmlspecialchars($user_item_subscriber['last_name']); ?>" class="itemUserSubcriber" onclick="window.location = 'profile.php?id=<?php echo(intval($user_item_subscriber['id'])); ?>'">
										<center>
											<?php if ($user_item_subscriber['avatar'] == '') { ?>
												<img class="avatarUserSub" src="<?php echo($url_no_avatar); ?>" draggable="false" oncontextmenu="return false">
											<?php } else { ?>
												<img class="avatarUserSub" src="<?php echo htmlspecialchars($user_item_subscriber['avatar']); ?>" draggable="false" oncontextmenu="return false">
											<?php } ?>
											<h2 class="userSubName"><?php echo($user_item_subscriber['first_name']); ?></h2>
										</center>
							    	</div>
							    	<?php
								}
							}
							echo('</div>');
							echo('</div>');
						}
					}
				}



				$query_subscribed = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$user_id' LIMIT 9");
				$query_subscribed_no_limit = mysqli_query($connect, "SELECT * FROM `subs` WHERE `friend1` = '$user_id'");
				if (mysqli_num_rows($query_subscribed) > 0) {
					if ($email != '' && $password != '') {
						if ($user_view['banned'] == 0) {
							echo('<div class="contentUser">');
							if ($user_view['email'] === $email && $user_view['password'] === $password) {
								echo('<div class="divTitleContent"><h2 class="textTitleContent">' . $string_my_subscribed . '<h2 class="textSubTitleContent">' . mysqli_num_rows($query_subscribed_no_limit) . '</h2></h2></div>');
							} else {
								echo('<div class="divTitleContent"><h2 class="textTitleContent">' . $string_other_subscribed . ' ' . $nc->q($user_view['first_name'], 1) . '<h2 class="textSubTitleContent">' . mysqli_num_rows($query_subscribed_no_limit) . '</h2></h2></div>');
							}

							echo('<div class="divListSubscribers">');
							while($row = mysqli_fetch_assoc($query_subscribed)) {
								$id_subscribed = intval($row['friend2']);
								$check_user_subscribed = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_subscribed'");
								if (mysqli_num_rows($check_user_subscribed) > 0) {
									$user_item_subscribed = mysqli_fetch_assoc($check_user_subscribed);
									?>
									<div title="<?php echo($user_item_subscribed['first_name']); ?> <?php echo($user_item_subscribed['last_name']); ?>" class="itemUserSubcriber" onclick="window.location = 'profile.php?id=<?php echo(intval($user_item_subscribed['id'])); ?>'">
										<center>
											<?php if ($user_item_subscribed['avatar'] == '') { ?>
												<img class="avatarUserSub" src="<?php echo($url_no_avatar); ?>" draggable="false" oncontextmenu="return false">
											<?php } else { ?>
												<img class="avatarUserSub" src="<?php echo htmlspecialchars($user_item_subscribed['avatar']); ?>" draggable="false" oncontextmenu="return false">
											<?php } ?>
											<h2 class="userSubName"><?php echo($user_item_subscribed['first_name']); ?></h2>
										</center>
							    	</div>
							    	<?php
								}
							}
							echo('</div>');
							echo('</div>');
						}
					}
				}


				echo('</div>'); }
				echo('<div class="contentAll">');
				echo('<div class="contentData">');
				if ($user_view['banned'] == 0) {
					if ($detect_device->isMobile()) { echo('<div class="mobileDivUserBig">'); }
					if ($detect_device->isMobile()) { echo('<div class="mobileDivNamesHor">'); }
					if ($detect_device->isMobile()) { echo('<img class="mobileUserAvatar" draggable="false" oncontextmenu="return false" src="'); if ($user_view['avatar'] == '') { echo($url_no_avatar); } else { echo($user_view['avatar']); } echo('">'); }
					if ($detect_device->isMobile()) { echo('<div class="mobileDivNamesVer">'); }
					if ($detect_device->isMobile()) { echo('<div class="mobileDivNames">'); }
					echo('<div class="divUserNick">');
					echo('<h2 class="nameUser">' . htmlspecialchars($user_view['first_name']) . ' ' . htmlspecialchars($user_view['last_name']) . '</h2>');
					if ($user_view['verification'] == 1) {
						echo('<div class="tooltip verification"><img draggable="false" oncontextmenu="return false" class="imgVerification" src="' . $url_verification_img . '"><span class="tooltiptext"><strong>' . $string_verification_description . '</strong><br><br>' . $string_verification_description_start . $nc->q($user_view['first_name'], 1) . $string_verification_description_end . '</span></div>');
					}
					echo('</div>'); 
					?>
					<h2 class="descriptionUser" <?php if ($user_view['email'] == $email && $user_view['password'] == $password) { echo('id="updateStatus"'); }?>><?php echo($user_view['description']); ?></h2>
					<?php 
					if ($detect_device->isMobile()) { echo('</div>'); } //MobileDiv
					if ($detect_device->isMobile()) { echo('</div>'); } //MobileDivVer
					if ($detect_device->isMobile()) { echo('</div>'); } //MobileDivHor

					if ($detect_device->isMobile()) { echo('<div class="mobileBottons">');
					if (mysqli_num_rows($check_user) > 0) {
						if (intval($user['id']) != intval($user_view['id'])) {
							if ($user_view['banned'] == 0) {
								?><button class="subscribe" id="subBtn" onclick="sendSub(<?php echo htmlspecialchars(intval($user_view['id'])); ?>)"><?php echo($string_user_subscribe); ?></button>
								<script type="text/javascript" src="js/subs_manager.js?v=4"></script><?php
								echo('<script type="text/javascript">checkSub(' . intval($user_view['id']) . ');</script>');
							}
						}
					}
					if ($user_view['banned'] == 0) {
						if (intval($user_view['id']) != intval($user['id'])) {
							echo('<button class="write_message" onclick="window.location = \'vendor/new_chat.php?id_user=' . intval($user_view['id']) . '\';">' . $string_write_message . '</button>');
						}
					}
					echo('</div>'); }

					if ($detect_device->isMobile()) { echo('</div>'); } //MobileDivBig
					if (!$detect_device->isMobile()) {echo('<hr class="info">'); }
					echo('<div class="infoDataContent1">');

					if ($user_view['happy'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_you_happy_day . ':</h2>');
						echo('<h2 class="infoDataMessage">' . $user_view['happy'] . '</h2>');
						echo('</div>');
					}

					if ($user_view['sex'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_select_sex . ':</h2>');
						if ($user_view['sex'] == 'm') {
							echo('<h2 class="infoDataMessage">' . $string_sex_man . '</h2>');
						} if ($user_view['sex'] == 'f') {
							echo('<h2 class="infoDataMessage">' . $string_sex_girl . '</h2>');
						} if ($user_view['sex'] == 'g') {
							echo('<h2 class="infoDataMessage">' . $string_sex_gendr . '</h2>');
						}
						echo('</div>');
					} if ($user_view['family_state'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_family_state . ':</h2>');
						if ($user_view['family_state'] == 0) {
							echo('<h2 class="infoDataMessage">' . $string_family_state_none . '</h2>');
						} if ($user_view['family_state'] == 1) {
							if ($user_view['sex'] == 'm') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_no_family_m . '</h2>');
							} if ($user_view['sex'] == 'f') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_no_family_f . '</h2>');
							}
						} if ($user_view['family_state'] == 2) {
							if ($user_view['sex'] == 'm') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_family_m . '</h2>');
							} if ($user_view['sex'] == 'f') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_family_f . '</h2>');
							}
						} if ($user_view['family_state'] == 3) {
							echo('<h2 class="infoDataMessage">' . $string_family_state_searched . '</h2>');
						} if ($user_view['family_state'] == 4) {
							if ($user_view['sex'] == 'm') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_pom_m . '</h2>');
							} if ($user_view['sex'] == 'f') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_pom_f . '</h2>');
							}
						} if ($user_view['family_state'] == 5) {
							echo('<h2 class="infoDataMessage">' . $string_family_state_country_brack . '</h2>');
						} if ($user_view['family_state'] == 6) {
							if ($user_view['sex'] == 'm') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_loved_m . '</h2>');
							} if ($user_view['sex'] == 'f') {
								echo('<h2 class="infoDataMessage">' . $string_family_state_loved_f . '</h2>');
							}
						} if ($user_view['family_state'] == 7) {
							echo('<h2 class="infoDataMessage">' . $string_family_state_not_loved . '</h2>');
						} if ($user_view['family_state'] == 8) {
							echo('<h2 class="infoDataMessage">' . $string_family_state_active_searching . '</h2>');
						}
						echo('</div>');
					}

					echo('</div>');
					echo('<h2 class="showOtherInfo" id="showOtherInfo">' . $string_show_other_information . '</h2>');
					echo('<div class="infoDataContent1" id="divOtherInformation" style="display: none;">');
					echo('<div class="infoCategory"><h2 class="infoCategory">' . $string_edit_contacts . '</h2><hr class="infoCategory"></div>');
					if ($user_view['site'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_contact_site . ':</h2>');
						echo('<h2 class="infoDataMessage"><a href="' . $user_view['site'] . '">' . $user_view['site'] . '</a></h2>');
						echo('</div>');
					} if ($user_view['vk'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_contact_vk . ':</h2>');
						echo('<h2 class="infoDataMessage"><a href="https://vk.com/' . $user_view['vk'] . '">' . $user_view['vk'] . '</a></h2>');
						echo('</div>');
					} if ($user_view['instagram'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_contact_instagram . ':</h2>');
						echo('<h2 class="infoDataMessage"><a href="https://instagram.com/' . $user_view['instagram'] . '">' . $user_view['instagram'] . '</a></h2>');
						echo('</div>');
					} if ($user_view['phone'] != '' || intval($user_view['phone']) != 0) {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_contact_phone . ':</h2>');
						echo('<h2 class="infoDataMessage">' . $user_view['phone'] . '</h2>');
						echo('</div>');
					}
					echo('<script type="text/javascript" src="js/div_other_information.js"></script>');



					echo('<div class="infoCategory"><h2 class="infoCategory">' . $string_edit_static_info . '</h2><hr class="infoCategory"></div>');
					if ($user_view['country'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_select_country . ':</h2>');
						echo('<h2 class="infoDataMessage">' . getCountry($user_view['country']) . '</h2>');
						echo('</div>');
					} if ($user_view['sity'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_select_sity . ':</h2>');
						echo('<h2 class="infoDataMessage">' . getSity($user_view['sity']) . '</h2>');
						echo('</div>');
					} if ($user_view['about'] != '') {
						echo('<div class="infoData"><h2 class="infoDataTitle">' . $string_about . ':</h2>');
						echo('<h2 class="infoDataMessage">' . $user_view['about'] . '</h2>');
						echo('</div>');
					}
					echo('</div>');
				} else {
					echo('<h2 class="nameUser">' . $string_banned . '</h2>');
					echo('<h2 class="descriptionUser"><strong>' . $string_banned . '</strong> ' . $user_view['text_banned'] . '</h2>');
				}
				echo('</div>');
				$query_images = mysqli_query($connect, "SELECT * FROM `images` WHERE `publisher` = '$user_id' ORDER BY date DESC");
				if (mysqli_num_rows($query_images) > 0) {
					if ($user_view['banned'] == 0) {
						echo('<div class="contentData">');
						if ($user_view['email'] === $email && $user_view['password'] === $password) {
							echo('<div class="divTitleContent"><h2 class="textTitleContent">' . $string_title_my_photos . '<h2 class="textSubTitleContent">' . mysqli_num_rows($query_images) . '</h2></h2><h2 class="add" id="uploadPhoto" title="' . $string_add_new_photo_desc . '">' . $string_add_new_photo . '</h2></div>');
						} else {
							echo('<div class="divTitleContent"><h2 class="textTitleContent">' . $string_title_photos . ' ' . $nc->q($user_view['first_name'], 1) . '<h2 class="textSubTitleContent">' . mysqli_num_rows($query_images) . '</h2></h2></div>');
						}
						
						if (mysqli_num_rows($query_images) > 0) {
							echo '<div class="userPhotosList">';
							while($row = mysqli_fetch_assoc($query_images)) {
							    echo('<div class="itemUserPhoto"><img draggable="false" oncontextmenu="return false" class="imgUserPhoto" src="' . $row['url'] . '">');
							    if ($user['banned'] == 0) {
									if (mysqli_num_rows($check_user) > 0) {
							    		echo('<div class="menuPhotos">');
							    		echo('<img onclick="window.location = \'vendor/edit/photo.php?t=set&img=' .  intval($row['id']) . '\';" draggable="false" oncontextmenu="return false" class="itemMenuPhoto" src="assets/icons/ic_avatar.png" title="' . $string_set_my_avatar . '" alt="' . $string_set_my_avatar . '">');
							    		echo('<img style="margin-left: 20px;" onclick="window.location = \'vendor/edit/photo.php?t=save&photo=' .  intval($row['id']) . '\';" draggable="false" oncontextmenu="return false" class="itemMenuPhoto" src="assets/icons/ic_save.png" title="' . $strins_save_photo_to_i . '" alt="' . $string_set_my_avatar . '">');
							    		echo('<img style="margin-left: 20px;" onclick="window.open(\'' .  $row['url'] . '\', \'_blank\');" draggable="false" oncontextmenu="return false" class="itemMenuPhoto" src="assets/icons/ic_download.png" title="' . $string_download_photo . '" alt="' . $string_download_photo . '">');
							    		if ($user_view['email'] === $email && $user_view['password'] === $password) {
							    			echo('<img style="margin-left: 20px;" onclick="window.location = \'vendor/edit/photo.php?t=pr&img=' .  intval($row['id']) . '\';" draggable="false" oncontextmenu="return false" class="itemMenuPhoto" src="assets/icons/ic_delete.png" title="' . $string_remove_photo . '" alt="' . $string_remove_photo . '">');
							    		}
							    		echo('</div>');
							    	}
							    }
							    echo('</div>');
							}
							echo '</div>';
						} else {
							echo '<b>Error: </b><br>' . '<br/>';
						}
						echo('</div>');
					}
				}

				if ($user_view['banned'] == 0) {
				if ($user_view['email'] === $email && $user_view['password'] === $password) {
					echo('<div class="contentData">');
					echo('<div class="postMake">');
					if ($user['avatar'] == '') {
						echo('<img class="avatarPost" oncontextmenu="return false" draggable="false" src="' . $url_no_avatar . '">');
					} else {
						echo('<img class="avatarPost" oncontextmenu="return false" draggable="false" src="' . $user['avatar'] . '">');
					}
					?>
					<form action="javascript:sendPost();" class="post" enctype="multipart/form-data">
						<input type="hidden" name="image" id="imageInput">
						<input autocomplete="off" class="post" id="postID" type="text" placeholder="<?php echo($string_hint_post); ?>">
						<img src="assets/icons/ic_post_doc.png" oncontextmenu="return false" draggable="false" id="postDocImg" class="docPost" title="<?php echo($string_post_doc); ?>">
						<button type="submit" class="post"><?php if ($detect_device->isMobile()) { echo($string_send_post_m); } else { echo($string_send_post); } ?></button>
					</form>
					<?php
					echo('</div>');
					?>
					<div class="postDocDiv" id="postDocDiv" style="display: none;">
						<?php
						$m_id_images = $user['id'];
						$query_images_post = mysqli_query($connect, "SELECT * FROM `images` WHERE `publisher` = '$m_id_images' ORDER BY date DESC");
						if (mysqli_num_rows($query_images_post) > 0) {
							if (mysqli_num_rows($query_images_post) > 0) {
								echo('<h2 class="titleListPost">' . $string_post_doc_image . '<h2 id="titleListPost"></h2></h2>');
								echo '<div class="userPhotosListPost">';
								while($row = mysqli_fetch_assoc($query_images_post)) {
									?>
									<img class="imgListPost" oncontextmenu="return false" draggable="false" src="<?php echo($row['url']); ?>" id="image<?php echo(intval($row['id'])); ?>" onclick="setImagePost(<?php echo('\''); echo($row['url']); echo('\''); ?>, <?php echo(''); echo(intval($row['id'])); echo(''); ?>)">
									<?php
								}
								?>
								<h2 class="hListPost" onclick="setImagePost('', 0)"><?php echo($string_post_doc_ex_image); ?></h2>
								<h2 class="hListPost" onclick="openUploadNewPhoto()"><?php echo($string_post_doc_add_image); ?></h2>
								<?php
								echo '</div>';
							}
						}	
						?>
					</div>
					<script type="text/javascript" src="js/post_doc.js"></script>
					<?php 
					echo('</div>');
				}
				?>
					<script type="text/javascript" src="js/posts_manager.js?v=3"></script>
				<?php
				echo('<div id="userPosts">');
				$user_posts = mysqli_query($connect, "SELECT * FROM `user_posts` WHERE `publishing` = '$user_id'");
				if (mysqli_num_rows($user_posts) > 0) {
					echo('<script type="text/javascript">loadPosts();</script>');
				} else {
					echo('<h2 class="no_posts">' . $string_no_posts . '</h2>');
				}
				echo('</div>');
				}


				echo('</div>');
				echo('</div>');
			} else {
				echo('<h2 class="titleBanned">' . $string_no_user . '</h2>');
			 	echo('<h3 class="messageBanned">' . $string_no_user_description . '</h3>');
			 	echo('<hr class="banned">');
			}
		?>

		<?php include 'alert/alert_status.php'; ?>
		<?php include 'alert/alert_update_avatar.php'; ?>
		<?php include 'alert/alert_upload_new_photo.php'; ?>

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
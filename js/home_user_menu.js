var userContent = document.getElementById('userContent');
var userMenu = document.getElementById('userMenu');
var arrow = document.getElementById('arrow');

userContent.onclick = openMenu;
userMenu.style.display = 'none';
arrow.style.opacity = '0.6';

function openMenu() {
	if (userMenu.style.display == 'none') {
		userMenu.style.display = 'block';
		arrow.style.opacity = '0.9';
		userContent.style.background_color = 'rgba(0, 0, 0, .2)';
	} else {
		userMenu.style.display = 'none';
		arrow.style.opacity = '0.6';
		userContent.style.background_color = 'rgba(0, 0, 0, 0)';
	}
}
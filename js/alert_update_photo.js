var alertUpdatePhoto = document.getElementById('alertUpdatePhoto');
var liUpdatePhoto = document.getElementById('liUpdatePhoto');
var closeAlertUpdatePhoto = document.getElementById('closeAlertUpdatePhoto');

liUpdatePhoto.onclick = openAlert;
closeAlertUpdatePhoto.onclick = openAlert;
alertUpdatePhoto.style.display = 'none';

function openAlert() {
	if (alertUpdatePhoto.style.display == 'none') {
		alertUpdatePhoto.style.display = 'flex';
	} else {
		alertUpdatePhoto.style.display = 'none';
	}
}
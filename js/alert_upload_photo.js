var alertUploadNewPhoto = document.getElementById('alertUploadPhoto');
var uploadPhoto = document.getElementById('uploadPhoto');
var closeAlertUploadNewPhoto = document.getElementById('closeAlertUploadPhoto');

uploadPhoto.onclick = openUploadNewPhoto;
closeAlertUploadNewPhoto.onclick = openUploadNewPhoto;
alertUploadNewPhoto.style.display = 'none';

function openUploadNewPhoto() {
	if (alertUploadNewPhoto.style.display == 'none') {
		alertUploadNewPhoto.style.display = 'flex';
	} else {
		alertUploadNewPhoto.style.display = 'none';
	}
}
var alertUpdateStatus = document.getElementById('alertUpdateStatus');
var updateStatus = document.getElementById('updateStatus');
var closeAlertUpdateStatus = document.getElementById('closeAlertUpdateStatus');

updateStatus.onclick = openAlertStatus;
closeAlertUpdateStatus.onclick = openAlertStatus;
alertUpdateStatus.style.display = 'none';

function openAlertStatus() {
	if (alertUpdateStatus.style.display == 'none') {
		alertUpdateStatus.style.display = 'flex';
	} else {
		alertUpdateStatus.style.display = 'none';
	}
}
var divOtherInformation = document.getElementById('divOtherInformation');
var showOtherInfo = document.getElementById('showOtherInfo');

showOtherInfo.onclick = openOtherInfo;
divOtherInformation.style.display = 'none';

function openOtherInfo() {
	if (divOtherInformation.style.display == 'none') {
		divOtherInformation.style.display = 'block';
		showOtherInfo.textContent = 'Скрыть подробную информацию';
	} else {
		divOtherInformation.style.display = 'none';
		showOtherInfo.textContent = 'Показать подробную информацию';
	}
}
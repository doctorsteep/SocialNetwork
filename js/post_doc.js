var postDocDiv = document.getElementById('postDocDiv');
var postDocImg = document.getElementById('postDocImg');
var imageInput = document.getElementById('imageInput');
var titleListPost = document.getElementById('titleListPost');

imageInput.value = '';

postDocImg.onclick = openPostDiv;
postDocDiv.style.display = 'none';

function openPostDiv() {
	if (postDocDiv.style.display == 'none') {
		postDocDiv.style.display = 'block';
		postDocImg.style.opacity = '1';
	} else {
		postDocDiv.style.display = 'none';
		postDocImg.style.opacity = '.5';
	}
}

function setImagePost(url, id) {
	if (url == '' && id == 0) {
		imageInput.value = '';
		titleListPost.textContent = '';
	} else {
		imageInput.value = url;
		titleListPost.textContent = '@id' + id;
	}
}
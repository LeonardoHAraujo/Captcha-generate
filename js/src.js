function reload() {
	let imgCaptcha = document.getElementById('captcha');
  	imgCaptcha.setAttribute('src', "captcha.php");
}

let reloadBtn = document.querySelector('#reload')
reloadBtn.addEventListener('click', reload)
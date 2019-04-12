var refreshButton = document.querySelector(".refresh-captcha");
refreshButton.onclick = function() {
document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
}       

<?php
session_start();
require_once __DIR__.'/model/DAO/CaptchaDAO.php';
require_once __DIR__.'/helpers/getIp.php';

$codeFromDb = (new CaptchaDAO())->getCodeCaptcha($_POST['captcha']);
$ip = getClientIp();

if($codeFromDb > 0 && $codeFromDb['ipAddress'] == $ip && $codeFromDb['isUsed'] == 0){	
	$_SESSION['msg'] = "<h3 style='color:green;'>Deu certo<h3>";
	(new CaptchaDAO())->updateIsUsed($codeFromDb['id']);
	header("Location: http://localhost:8080/");
}else{
	$_SESSION['msg'] = "<h3 style='color:red;'>ERRO! Código inválido.<h3>";
	header("Location: http://localhost:8080/");
}
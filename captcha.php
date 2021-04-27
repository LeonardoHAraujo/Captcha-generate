<?php 

session_start();

require_once __DIR__.'/model/DAO/CaptchaDAO.php';
require_once __DIR__.'/helpers/getIp.php';

function generate() {
	$numbers1 = [1, 2, 4, 5, 7, 6, 9, 8, 10];
	$numbers2 = [9, 10, 12, 7, 8, 3, 1, 2, 11];
	$operators = ['+', '-', 'x'];

	$randNum1 = array_rand($numbers1, 1);
	$randNum2 = array_rand($numbers2, 1);
	$randOp = array_rand($operators, 1);

	$n1 = '';
	$n2 = '';
	$count = '';
	$result = '';

	switch($operators[$randOp]) {
		case '+':
			$n1 = (int)$numbers1[$randNum1];
			$n2 = (int)$numbers2[$randNum2];
			$count = "{$n1} + {$n2}";
			$result = $n1 + $n2;
			break;

		case '-':
			$n1 = (int)$numbers1[$randNum1];
			$n2 = (int)$numbers2[$randNum2];
			$count = "{$n1} - {$n2}";
			$result = $n1 - $n2;
			break;

		case 'x':
			$n1 = (int)$numbers1[$randNum1];
			$n2 = (int)$numbers2[$randNum2];
			$count = "{$n1} x {$n2}";
			$result = $n1 * $n2;
			break;
	}

	$code = $count;
	$_SESSION['captcha'] = $result;

	$backgrounds = [
		'bg3.png',
		'bg4.png',
		'bg6.png',
		'bg7.png'
	];

	$fonts = [
		'anonymous.gdf',
		'HomBoldU_16x24_LE.gdf',
		'HomBoldB_16x24_LE.gdf'
	];

	$bgRandKey = array_rand($backgrounds, 1);
	$fontRandKey = array_rand($fonts, 1);

	$imgCaptcha = @imagecreatefrompng("bgs/{$backgrounds[$bgRandKey]}");
	$fontCaptcha = imageloadfont("fonts/{$fonts[$fontRandKey]}");
	$colorCaptcha = imagecolorallocate(1,0,98,215);

	header("Content-type: image/png");

	imagestring($imgCaptcha, $fontCaptcha, 15, 5, $code, $colorCaptcha);
	imagepng($imgCaptcha);
	imagedestroy($imgCaptcha);

	return $result;
}

$ip = getClientIp();
(new CaptchaDAO)->insertCodeCaptcha(generate(), $ip);
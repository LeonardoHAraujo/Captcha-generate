<?php

function getClientIp() {
    $ipaddress = '';
    if (isset($_SERVER['REMOTE_ADDR'])) {
    	$ipaddress = $_SERVER['REMOTE_ADDR'];
    } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    	$ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['HTTP_INCAP_CLIENT_IP'])) {
    	$ipaddress = $_SERVER['HTTP_INCAP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_SUCURI_CLIENTIP'])) {
    	$ipaddress = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
    } else {
    	$ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}
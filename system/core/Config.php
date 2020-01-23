<?php

function redirect($url) {
	header('location:' . ROOT_URL . $url);
}

function csrf_generate() {
	$token = md5(uniqid(rand(), true));
	$_SESSION['token'] = $token;
}

function csrf_token() {
	echo $_SESSION['token'];
}

function csrf_check($token) {
	if($_SESSION['token'] == $token) return true;
	else return false;
}
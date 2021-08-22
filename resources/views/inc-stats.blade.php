<?php
use App\Stat;

if (isset($_GET['a']) AND $_GET['a'] == 'dev') {
	setcookie('dev', 'Y', time() + (86400 * 30 * 12), "/"); // 86400 = 1 day	
}

if (!isset($_COOKIE['dev'])) {

	$log = array();
	$log = array(
		'DATE'					=> date("Y-m-d",time()),
		'TIME'					=> date("h:i:s",time()),
		'UTIME'					=> time(),
		'REQUEST_URI'			=> (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : "",
		'REDIRECT_URL'			=> (isset($_SERVER['REDIRECT_URL'])) ? $_SERVER['REDIRECT_URL'] : "",
		'HTTP_REFERER'			=> (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "",
		'XSRF-TOKEN'			=> (isset($_COOKIE['XSRF-TOKEN'])) ? $_COOKIE['XSRF-TOKEN'] : "",
		'SESSION'				=> (isset($_COOKIE['mon_oralnet_session'])) ? $_COOKIE['mon_oralnet_session'] : "",	
		'HTTP_ACCEPT_LANGUAGE'	=> (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "",
		'HTTP_USER_AGENT'		=> (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : "",
		'GEOIP_COUNTRY_NAME'	=> (isset($_SERVER['GEOIP_COUNTRY_NAME'])) ? $_SERVER['GEOIP_COUNTRY_NAME'] : "",
		'GEOIP_COUNTRY_CODE'	=> (isset($_SERVER['GEOIP_COUNTRY_CODE'])) ? $_SERVER['GEOIP_COUNTRY_CODE'] : "",
		'GEOIP_CITY'			=> (isset($_SERVER['GEOIP_CITY'])) ? $_SERVER['GEOIP_CITY'] : "",
		'GEOIP_REGION_NAME'		=> (isset($_SERVER['GEOIP_REGION_NAME'])) ? $_SERVER['GEOIP_REGION_NAME'] : "",
	);

	Stat::create([
		'log' => json_encode($log),
	]);
	
}
?>
<?php

if (preg_match ("/www/i", $_SERVER['HTTP_HOST']))
{
	$str=str_replace('www.', '', $_SERVER['HTTP_HOST']);
	header("HTTP/1.1 301 Moved Permanently");
	header ('Location: https://'.$str.$_SERVER['REQUEST_URI']);
	die();
}

preg_match ( '/(?:www\.)?oknaorg.ru\/([^\/\?\.]+)\/?/', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $city);
$city = (isset($city[1]) && 
		$city[1]!='site' && 
		$city[1]!='out' && 
		$city[1]!='city' && 
		$city[1]!='company' && 
		$city[1]!='news' && 
		$city[1]!='companyParse' && 
		$city[1]!='feedback' && 
		$city[1]!='map' && 
		$city[1]!='help' && 
		$city[1]!='page' && 
		$city[1]!='companyNew' && 
		$city[1]!='pricecity' && 
		$city[1]!='gii' && 
		$city[1]!='review'
		) ? $city[1] : false;
// this contains the application parameters that can be maintained via GUI
return array(
	'adminEmail'=>'oknaorg@mail.ru',
	'city' => $city,
	'dateFormat'=>'d.m.Y',
);

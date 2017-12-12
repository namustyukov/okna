<?
	foreach ($categories as $category)
		echo iconv('windows-1251', 'UTF-8', $category).'<br>';
?>
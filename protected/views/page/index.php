<?php
$this->menu=array(
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li>Статьи</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>
			Полезная информация о пластиковых окнах
			<?=($_GET['page'] ? ' | Страница '.$_GET['page'] : '')?>
		</h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
		<div class="sidebar_page_list">
			<h2>ТОП-5 САМЫХ ПОПУЛЯРНЫХ СТАТЕЙ</h2>
			<ul>
			<?
				foreach ($page_top as $row)
				{
					$date=explode(".",date('d.m.Y', $row->date_create));
					switch ($date[1]){
						case 1: $m='января'; break;
						case 2: $m='февраля'; break;
						case 3: $m='марта'; break;
						case 4: $m='апреля'; break;
						case 5: $m='мая'; break;
						case 6: $m='июня'; break;
						case 7: $m='июля'; break;
						case 8: $m='августа'; break;
						case 9: $m='сентября'; break;
						case 10: $m='октября'; break;
						case 11: $m='ноября'; break;
						case 12: $m='декабря'; break;
					};
			?>
				<li>
					<small><i>Просмотров <?=$row->view_count?></i> | <?=$date[0]*1.0?> <?=$m?> <?=$date[2]?></small>
					<span>
						<a href="/page/<?=$row->url?>"><?=$row->title?></a>
					</span>
				</li>
			<? } ?>
			</ul>
		</div>
		<div class="sidebar_market_href_tiz __gg">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- oknaorg стартовая  сайдбар -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:240px;height:400px"
			     data-ad-client="ca-pub-9040033498726551"
			     data-ad-slot="6220009225"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		<? if ($this->show_market && 0) { ?>
		<div class="sidebar_market_href_tiz">
			<script>(function(e){var t="DIV_DA_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="directadvert-block directadvert-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_directadvert){loaded_blocks_directadvert=[]; function n(){var e=loaded_blocks_directadvert.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.directadvert.ru/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_directadvert.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_directadvert.push({adp_id:e,div:t})})(536223)</script>
		</div>
		<? } ?>
	</div>
	<div class="content">
		<div class="content_news_list">
		<? 
			$news_sch = 0;
			foreach ($page_list as $row)
			{
		?>
			<div class="content_news_item">
				<div class="content_news_item_control">
					<div class="content_news_date">
					<?
						$date=explode(".",date('d.m.Y', $row->date_create));
						switch ($date[1]){
							case 1: $m='января'; break;
							case 2: $m='февраля'; break;
							case 3: $m='марта'; break;
							case 4: $m='апреля'; break;
							case 5: $m='мая'; break;
							case 6: $m='июня'; break;
							case 7: $m='июля'; break;
							case 8: $m='августа'; break;
							case 9: $m='сентября'; break;
							case 10: $m='октября'; break;
							case 11: $m='ноября'; break;
							case 12: $m='декабря'; break;
						};
					?>
						<span><?=$date[0]*1.0?> <?=$m?> <?=$date[2]?></span> | Количество просмотров <?=$row->view_count?>
					</div>
				</div>
				<div class="content_news_item_content">
					<div class="content_news_item_icon">
						<img src="/imgPage/<?=$row->logo?>" alt="<?=$row->title?>">
					</div>
					<div class="content_news_item_preview">
						<div class="content_news_item_head">
							<a href="/page/<?=$row->url?>"><?=$row->title?></a>
						</div>
						<p><?=$row->preview?></p>
					</div>
				</div>
			</div>
		<?
				$news_sch++;
				if ($news_sch == 5)
				{
					?>
						<div class="start_market_between_tiz __gorod __gg">
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- oknaorg в контенте -->
							<ins class="adsbygoogle"
							     style="display:inline-block;width:728px;height:90px"
							     data-ad-client="ca-pub-9040033498726551"
							     data-ad-slot="6619975228"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
						<? if ($this->show_market && 0) { ?>
						<div class="start_market_between_tiz __gorod">
							<script>(function(e){var t="DIV_DA_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="directadvert-block directadvert-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_directadvert){loaded_blocks_directadvert=[]; function n(){var e=loaded_blocks_directadvert.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.directadvert.ru/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_directadvert.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_directadvert.push({adp_id:e,div:t})})(536343)</script>
						</div>
						<? } ?>
					<?
				}
			}
		?>
		</div>
		<div class="content_news_list_page">
		<?
			$this->widget('CLinkPager', array(
				'pages' => $pages,
				'maxButtonCount'=>15,
				'cssFile'=>false,
				'header'=>'<span>Страницы</span>',
				'nextPageLabel'=>'Следующая',
				'prevPageLabel'=>'Предыдущая',
				'lastPageLabel'=>'Последняя',
				'firstPageLabel'=>'Первая',
			));
		?>
		</div>
	</div>
</div>
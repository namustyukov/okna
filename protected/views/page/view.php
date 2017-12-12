<?php
/* @var $this PageController */
/* @var $model Page */
$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/page/list">Список статей</a></li>
			<li><?=$model->title?></li>
		</ul>
	</div>
	<div class="page_name">
		<h1><?=$model->title?></h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
		<div class="sidebar_page_view">
			<h2>ИНФОРМАЦИЯ О СТАТЬЕ</h2>
			<ul>
				<li>
				<?
					$date=explode(".",date('d.m.Y', $model->date_create));
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
					<small>Дата написания</small>
					<span><?=$date[0]*1.0?> <?=$m?> <?=$date[2]?></span>
				</li>
				<li>
					<small>Количество просмотров</small>
					<span><?=$model->view_count?></span>
				</li>
				<li>
					<small>Тема обсуждения</small>
					<span><?=$this->meta_d?></span>
				</li>
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
		<div class="content_page_view">
			<div class="content_page_view_icon">
				<img src="/imgPage/<?=$model->logo?>" alt="<?=$model->title?>">
			</div>
			<?=$model->content?>
		</div>
		<div class="same_page_view">
			<h4>Похожие статьи</h4>
			<ul>
			<?php foreach ($same_page as $row) { ?>
				<li>
					<a href="/page/<?=$row->url?>"><?=$row->title?></a>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>
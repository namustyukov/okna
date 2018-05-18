<?php
$this->menu=array(
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/<?=$this->city->simbol_name?>"><?=$this->city->gorod?></a></li>
			<li><a href="/<?=$this->city->simbol_name?>/company/list">Производители окон</a></li>
			<li>Акции и скидки</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Акции и скидки на пластиковые окна в <?=$this->city->gorode?></h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
	</div>
	<div class="content">
	<? if (count($companies)) { ?>
		<div class="page-description __mb __radius">
			<p>Информация о скидках и акциях собрана с <?=$companies_count?> <?=$this->city->kakih?> компаний и ежеквартально обновляется. В краткой форме представлены проходящие рекламные акции и распродажи, а так же ведется обзор купонных скидок, действующих в <?=$this->city->gorode?>.
			<p>Для получения более точной и детальной информации свяжитесь со специалистами фирм по указанным телефонным номерам.</p>
			<p>Наличие промо-акций у компаний влияет на занимаемое ими место в <a href="/<?=$this->city->simbol_name?>/company/list">рейтинге <?=$this->city->kakih?> фирм</a>.</p>
		</div>
		<div class="content_promo_list">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="1%">
						<div class="promo_header_rating">Рейтинг (из <?=$companies_count?> фирм)</div>
					</td>
					<td width="1%">
						<div class="promo_header_name">Наименование компании</div>
					</td>
					<td>
						<div class="promo_header_price">Информация об акциях и скидках</div>
					</td>
				</tr>
				<? foreach ($companies as $key => $row) { ?>
					<tr>
						<td>
							<div class="promo_item_rating">
								<div class="promo_item_rating_stars">
								<?
									$count_stars = 5 - floor($row->rating/ceil($companies_count/6));
									for ($j=0; $j < 5; $j++)
									{
										$class = '__stars_bad';
										if ($j < $count_stars)
											$class = '__stars_good';
										echo '<span class="'.$class.'"></span>';
									}
								?>
								</div>
								<div class="promo_item_rating_text">
									<?=$row->rating?> из <?=$companies_count?>
								</div>
							</div>
						</td>
						<td>
							<div class="promo_item_name">
								<a href="/<?=$this->city->simbol_name?>/company/<?=$row->url?>"><?=$row->name?></a>
								<?
									if ($row->phone)
									{
										$phone_arr = explode(",", $row->phone);
										echo '<span>'.$phone_arr[0].'</span>';
									}
								?>
							</div>
						</td>
						<td>
							<div class="promo_item_price"><?=$row->promo?></div>
						</td>
					</tr>
				<?
						if ($key == 5 && count($companies) > 6)
						{
							?>
								<tr>
									<td colspan="3">
										<div class="start_market_between_tiz __gg">
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
									</td>
								</tr>
								<? if ($this->show_market && 0) { ?>
								<tr>
									<td colspan="3">
										<div class="start_market_between_tiz">
											<script>(function(e){var t="DIV_DA_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="directadvert-block directadvert-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_directadvert){loaded_blocks_directadvert=[]; function n(){var e=loaded_blocks_directadvert.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.directadvert.ru/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_directadvert.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_directadvert.push({adp_id:e,div:t})})(536343)</script>
										</div>
									</td>
								</tr>
								<? } ?>
							<?
						}
					}
				?>
			</table>
		</div>
	<? }else{ ?>
		<div class="content_promo_empty">
			<p>Запущено обновление информации об акциях на пластиковые окна в <?=$this->city->gorode?>.<br />Операция продлится в течение нескольких дней.</p>
			<p>Просим прощения за оказанные неудобства. Команда OKNAORG.RU стремится предоставить самую актуальную и своевременную информацию о скидках на пластиковые окна в городе <?=$this->city->gorod?>. Полный перечень компаний представлен в разделе <a href="/<?=$this->city->simbol_name?>/company/list">Производители пластиковых окон в <?=$this->city->gorode?></a>.</p>
		</div>
	<? } ?>
	</div>
</div>
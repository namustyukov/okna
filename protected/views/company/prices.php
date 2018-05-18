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
			<li>Цены на пластиковые окна</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Цены на пластиковые окна в <?=$this->city->gorode?></h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
	</div>
	<div class="content">
		<div class="page-description __mb __radius">
			<p>В таблице представлена информация о ценах на пластиковые окна, которые в открытом доступе публикуют <?=$this->city->kakie?> компании. Для получения более детальной информации о стоимости окон и услуг свяжитесь с представителем фирмы по указанным телефонным номерам.</p>
			<p>Фирмы отсортированы согласно их рейтингу на <?= date('Y') ?> год. Весь перечень компаний представлен в разделе <a href="/<?=$this->city->simbol_name?>/company/list">Производители пластиковых окон в <?=$this->city->gorode?></a>.</p>
		</div>
	<? if (count($companies)) { ?>
		<div class="content_prices_list">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="1%">
						<div class="prices_header_rating">Рейтинг (из <?=$companies_count?> фирм)</div>
					</td>
					<td width="1%">
						<div class="prices_header_name">Наименование компании</div>
					</td>
					<td>
						<div class="prices_header_price">Информация о стоимости окна</div>
					</td>
				</tr>
				<? foreach ($companies as $key => $row) { ?>
					<tr>
						<td>
							<div class="prices_item_rating">
								<div class="prices_item_rating_stars">
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
								<div class="prices_item_rating_text">
									<?=$row->rating?> из <?=$companies_count?>
								</div>
							</div>
						</td>
						<td>
							<div class="prices_item_name">
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
							<div class="prices_item_price"><?=$row->price?></div>
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
	<? } ?>
		<div class="prices_graph_wrapper">
			<h2>Среднерыночная цена окна за 1 м. кв.</h2>
			<div class="prices_graph">
			<? foreach ($pricecity as $key => $row) { ?>
				<div class="prices_graph_item __i<?=($key + 1)?>">
					<div class="prices_graph_item_p">
						<div class="prices_graph_item_label">
							<small><?=($row->price + $this->city->id)?> р.</small>
							<small class="<?=$row->diff > 0 ? '__up' : '__down'?>"><?=abs($row->diff)?>%</small>
						</div>
					</div>
					<div class="prices_graph_item_pk">
						<div class="prices_graph_item_label">
							<small><?=($row->price_key + $this->city->id)?> р.</small>
							<small class="<?=$row->diff_key > 0 ? '__up' : '__down'?>"><?=abs($row->diff_key)?>%</small>
						</div>
					</div>
					<span><?=$row->date_create?></span>
				</div>
			<? 
					if ($key + 1 >= 18) break;
				}
			?>
			</div>
			<div class="prices_graph_title">
				<div class="prices_graph_title_legend">
					<span class="__red">Среднерыночная цена окна за 1 м. кв.</span>
					<span class="__blue">Цена окна под ключ</span>
				</div>
				<div class="prices_graph_title_from">
					Данные предоставлены oknamedia.ru
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var max_price = <?=$max_price?>;
	var pricecity = [];
	<? foreach ($pricecity as $key => $row) { ?>
		pricecity[<?=$key?>] = { date_create: '<?=$row->date_create?>', price: <?=($row->price + $this->city->id)?>, diff: <?=$row->diff?>, price_key: <?=($row->price_key + $this->city->id)?>, diff_key: <?=$row->diff_key?> };
	<? } ?>
	$(document).ready(function(){
		if (pricecity && pricecity.length)
		{
			for (var i = 0; i < pricecity.length; i++)
			{
				var height = ( pricecity[i].price / max_price ) * 280;
				$('.prices_graph_item.__i' + (i + 1) + ' .prices_graph_item_p').animate({
					height: height + 'px'
				}, 1000);
				var height_key = ( pricecity[i].price_key / max_price ) * 280;
				$('.prices_graph_item.__i' + (i + 1) + ' .prices_graph_item_pk').animate({
					height: height_key + 'px'
				}, 1000);
			}
		}
	});
</script>
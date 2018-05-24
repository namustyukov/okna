<div class="header_name">
	<div class="page_name">
		<h1>Пластиковые окна в <?=$this->city->gorode?></h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
	<?php if (0) { ?>
		<div class="sidebar_news_view">
			<div class="sidebar_news_view_another">
				<h2>НОВОСТИ <?=$this->city->goroda?></h2>
				<ul>
				<?
					foreach ($news as $row)
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
						/*$type = '';
						switch ($row->type){
							case 'update': $type = 'Информация о компании'; break;
							case 'detail': $type = 'Новость '.$this->city->goroda; break;
						};*/
				?>
					<li>
						<small><i><?=$date[0]*1.0?> <?=$m?> <?=$date[2]?></i></small>
						<span>
							<?=str_replace('{company}', '<a href="/'.$row->city->simbol_name.'/company/'.$row->company->url.'">'.$row->company->name.'</a>', $row->preview)?>
						</span>
					</li>
				<? } ?>
				</ul>
				<div class="news_href">
					<a href="/<?=$this->city->simbol_name?>/news/list">Все новости</a>
				</div>
			</div>
		</div>
	<?php } ?>
		<div class="sidebar_market_href_tiz __gorod __gg">
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
		<div class="sidebar_market_href_tiz __gorod">
			<script>(function(e){var t="DIV_DA_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="directadvert-block directadvert-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_directadvert){loaded_blocks_directadvert=[]; function n(){var e=loaded_blocks_directadvert.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.directadvert.ru/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_directadvert.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_directadvert.push({adp_id:e,div:t})})(536223)</script>
		</div>
		<? } ?>
	</div>
	<div class="content">
		<div class="content_gorod">
			<div class="content_gorod_price_wrapper">
				<h2>Анализ изменения цен на окна</h2>
				<div class="page-description">
					<p>За последний месяц средняя стоимость 1 м2 окна <?= $pricecity[0]->diff > 0 ? 'возросла' : 'уменьшилась' ?> на <?= abs($pricecity[0]->diff) ?>% и составляет <?= $pricecity[0]->price + $this->city->id ?> руб. По дешевизне окон <?= $this->city->gorod ?> занимает <?=$this->city->rating?> место среди <a href="/city/list">представленных городов России</a>.</p>
				</div>
				<div class="content_gorod_price">
					<div class="gorod_price_graph">
					<? foreach ($pricecity as $key => $row) { ?>
						<div class="gorod_prices_graph_item __i<?=($key + 1)?>">
							<div class="gorod_prices_graph_item_p">
								<div class="gorod_prices_graph_item_label">
									<small><?=($row->price + $this->city->id)?> р.</small>
									<small class="<?=$row->diff > 0 ? '__up' : '__down'?>"><?=abs($row->diff)?>%</small>
								</div>
							</div>
							<div class="gorod_prices_graph_item_pk">
								<div class="gorod_prices_graph_item_label">
									<small><?=($row->price_key + $this->city->id)?> р.</small>
									<small class="<?=$row->diff_key > 0 ? '__up' : '__down'?>"><?=abs($row->diff_key)?>%</small>
								</div>
							</div>
							<span><?=$row->date_create?></span>
						</div>
					<? 
							if ($key + 1 >= 12) break;
						}
					?>
					</div>
					<div class="gorod_price_text">
						<h4>Выгодные цены от:</h4>
						<ul>
						<?
							if (!count($companies_price))
								$companies_price = $companies;
							$sch = 0;
							foreach ($companies_price as $row)
							{
						?>
								<li>
									<?
										if ($row->rating)
										{
											$count = count($companies);
											$count_stars = 5 - floor($row->rating/ceil($count/6));
											echo '<div class="gorod_price_text_company_stars">';
											for ($j=0; $j < 5; $j++)
											{
												$class = '__stars_bad';
												if ($j < $count_stars)
													$class = '__stars_good';
												echo '<span class="'.$class.'"></span>';
											}
											echo '</div>';
										}
									?>
									<div class="gorod_price_text_company_title">
										<a href="/<?=$this->city->simbol_name?>/company/<?=$row->url?>"><?=$row->name?></a>
									</div>
								</li>
						<?
								$sch++;
								if ($sch >= 5) break;
							}
						?>
							<li><a href="/<?=$this->city->simbol_name?>/prices/list">Сравнить цены всех <?= $this->city->kakih ?> компаний</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="gorod_promo_wrapper">
				<h3>Акции и скидки компаний</h3>
				<div class="page-description">
					<p>
						В <?= $this->city->gorode ?> акции на установку и покупку окон предоставляют <?= count($promoes) ?> компаний.
						<?php
							if (count($promoes)) {
								echo 'Диапазон скидок варьируется от 5% до '.(50 - ($this->city->id % 10)).'%. Ниже представлены акции от ТОП-вых фирм.';
							}
						?>
					</p>
				</div>
				<div class="gorod_promo_list">
			<?
				if (count($promoes))
				{
					$sch = 0;
					foreach ($promoes as $row)
					{
						$sch++;
			?>
					<div class="gorod_promo_item">
						<a href="/<?=$this->city->simbol_name?>/company/<?=$row->url?>"><?=$row->name?></a> - <?=$row->promo?>
					</div>
			<?
						if ($sch >= 3) break;
					}
				}
				else
					echo '<div class="gorod_promo_item_no">Информация отсутствует</div>';
			?>
					<div class="gorod_promo_item">
						<a href="/<?=$this->city->simbol_name?>/promo/list">Все акции <?= $this->city->goroda ?></a>
					</div>
				</div>
			</div>
			<div class="gorod_review_wrapper">
				<h3>Отзывы покупателей</h3>
				<?php if (count($reviewsGroup)) { ?>
				<div class="page-description">
					<?php
						$goodText = '';
						if (count($reviewsGroupGood)) {
							$goodText = 'Только положительные отзывы у фирм ';

							$key = 0;
							foreach ($reviewsGroupGood as $company) {
								$goodText .= '<a href="/'.$this->city->simbol_name.'/company/'.$company->url.'">'.$company->name.'</a>, ';
								$key++;
								if ($key >= 3) break;
							}

							if (count($reviewsGroupGood) > 3) {
								$goodText .= 'и еще '.(count($reviewsGroupGood) - 3).' компаний.';
							}
						}

						$badText = '';
						if (count($reviewsGroupBad) >= 2) {
							$badText = 'Больше всего отрицательных отзывов у 
								<a href="/'.$this->city->simbol_name.'/company/'.$reviewsGroupBad[0]->url.'">'.$reviewsGroupBad[0]->name.'</a> и
								<a href="/'.$this->city->simbol_name.'/company/'.$reviewsGroupBad[1]->url.'">'.$reviewsGroupBad[1]->name.'</a>.
							';
						}
					?>
					<p>
						Наиболее обсуждаемая компания <?= $this->city->goroda ?> - <a href="/<?=$this->city->simbol_name?>/company/<?=$reviewsGroup[0]->url?>"><?=$reviewsGroup[0]->name?></a> (<?=$reviewsGroup[0]->good?> положительных и <?=$reviewsGroup[0]->bad?> отрицательных отзыва). <?=$goodText?> <?=$badText?> Ниже представлены самые свежие отзывы на окна <?= $this->city->kakih ?> компаний.
					</p>
				</div>
				<?php } ?>
				<div class="gorod_review_list">
			<?
				if (count($reviews))
				{
					$sch = 0;
					foreach ($reviews as $row)
					{
						$sch++;
						$date = explode(".",date('d.m.Y', $row->add_time));
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
					<div class="gorod_review_item <?=($row->mark == 1 ? '__good' : ($row->mark == -1 ? '__bad' : ''))?>">
						<div class="gorod_review_item_header">
							<span><?=$row->name?></span> | <i><?=$date[0]*1.0?> <?=$m?> <?=$date[2]?></i><br />отзыв о фирме <span><a href="/<?=$this->city->simbol_name?>/company/<?=$row->company->url?>"><?=$row->company->name?></a></span>
						</div>
						<div class="gorod_review_item_content">
							<p><?=$row->text?></p>
						</div>
					</div>
			<?
						if ($sch >= 3) break;
					}
				}
				else
					echo '<div class="gorod_review_item_no">Информация отсутствует</div>';
			?>
					<div class="gorod_review_item_all">
						<a href="/<?=$this->city->simbol_name?>/review/list">Все отзывы в <?= $this->city->gorode ?></a>
					</div>
				</div>
			</div>
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
			<div class="content_gorod_company">
				<h3>Список компаний из ТОП-10 по <?=$this->city->gorodu?></h3>
				<div class="content_gorod_company_list">
					<div class="content_gorod_company_row_header">
						<div class="gorod_company_name_header">
							Наименование компании
						</div>
						<div class="gorod_company_service_header">
							Спектр услуг
						</div>
						<div class="gorod_company_price_header">
							Информация о ценах
						</div>
					</div>
				<?
					$sch = 0;
					foreach ($companies as $row)
					{
				?>
						<div class="content_gorod_company_row">
							<div class="gorod_company_name">
								<div class="gorod_company_name_img">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$row->logo ? $row->logo : 'defineLogo.jpg'?>" alt="<?=$row->name?> в <?=$this->city->gorode?>" />
								</div>
								<div class="gorod_company_name_info">
									<div class="gorod_company_name_title">
										<a href="/<?=$this->city->simbol_name?>/company/<?=$row->url?>"><?=$row->name?></a>
									</div>
									<?
										if ($row->rating)
										{ 
											$count_stars = 5 - floor($row->rating/ceil($count/6));
											echo '<div class="gorod_company_name_rating_stars">';
											for ($j=0; $j < 5; $j++)
											{
												$class = '__stars_bad';
												if ($j < $count_stars)
													$class = '__stars_good';
												echo '<span class="'.$class.'"></span>';
											}
											echo '</div>';
									?>
										<div class="gorod_company_name_rating_text">
											Рейтинг <?=$row->rating?> из <?=$count?>
										</div>
									<?
										}
									?>
								</div>
							</div>
							<div class="gorod_company_service">
							<?
								echo '<ul>';
								if (count($row->service))
								{
									foreach ($row->service as $service)
									{
										if ($service->service->text == 'Виды окон')
										{
											echo '<li>Производство окон</li>';
											echo '<li>Установка и монтаж</li>';
											echo '<li>Остекление балконов</li>';
										}
										elseif ($service->service->text == 'Услуги и ремонт окон')
											echo '<li>Обслуживание и ремонт</li>';
										else
											echo '<li>'.$service->service->text.'</li>';
									}
								}
								else
								{
									if ($row->id % 2 == 1) {
										echo '<li>Производство окон</li>';
										echo '<li>Установка и монтаж</li>';
										echo '<li>Остекление балконов</li>';
									} else {
										echo '<li>Производство окон</li>';
										echo '<li>Установка и монтаж</li>';
									}
								}
								echo '</ul>';
							?>
							</div>
							<div class="gorod_company_price">
								<?=($row->price ? $row->price : '&mdash;')?>
							</div>
						</div>
				<?
						$sch++;
						if ($sch >= 10)
							break;
					}
				?>
					<div class="content_gorod_company_row_all">
						<a href="/<?=$this->city->simbol_name?>/company/list">Все фирмы <?=$this->city->goroda?></a>
					</div>
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
				var height = ( pricecity[i].price / max_price ) * 210;
				$('.gorod_prices_graph_item.__i' + (i + 1) + ' .gorod_prices_graph_item_p').animate({
					height: height + 'px'
				}, 1000);
				var height_key = ( pricecity[i].price_key / max_price ) * 210;
				$('.gorod_prices_graph_item.__i' + (i + 1) + ' .gorod_prices_graph_item_pk').animate({
					height: height_key + 'px'
				}, 1000);
			}
		}
	});
</script>
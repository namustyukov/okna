<?php

$this->menu=array(
	array('label'=>'Create Review', 'url'=>array('create')),
	array('label'=>'Manage Review', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/<?=$this->city->simbol_name?>"><?=$this->city->gorod?></a></li>
			<li>Отзывы о фирмах	<?=$this->city->goroda?></li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Отзывы на пластиковые окна в <?=$this->city->gorode?>: мнения, советы, жалобы и недовольства</h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
		<div class="sidebar_review_list">
			<h2>САМЫЕ ОБСУЖДАЕМЫЕ ОКНА <a href="/<?=$this->city->simbol_name?>"><?=$this->city->goroda?></a></h2>
			<div class="sidebar_review_list_filtr">
				<ul>
				<? foreach ($companies_order as $row) { ?>
					<li>
						<a href="/<?=$this->city->simbol_name?>/company/<?=$row->url?>"><?=$row->name?> (<?=$row->count?>)</a>
						<?
							if ($row->rating)
							{ 
								$count_stars = 5 - floor($row->rating/ceil(count($companies_order)/6));
								echo '<div class="sidebar_review_list_filtr_stars">';
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
					</li>
				<? } ?>
				</ul>
			</div>
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
	<? if (!count($reviewes)) { ?>
		<div class="content_review_list_empty">
			<p>К сожалению в <?=$this->city->gorode?> пока нет ни одного отзыва<br />на пластиковые окна от фирм города. Вы можете стать первым.</p>
		</div>
	<? } ?>
		<div class="review_add">
			<div class="review_add_button <?=!count($reviewes) ? '__active' : ''?>">
				<span>Добавить отзыв</span>
			</div>
			<div class="review_form <?=!count($reviewes) ? '__show' : ''?>">
				<div class="review_field">
					<div class="review_field_title">
						Ваше имя
					</div>
					<div class="review_field_input">
						<input type="text" name="name" id="name" />
						<div class="review_field_input_error">Ошибка</div>
					</div>
				</div>
				<div class="review_field">
					<div class="review_field_title">
						Компания
					</div>
					<div class="review_field_input">
						<select name="company" id="company">
							<option value="-100">Выберите  компанию</option>
						<? foreach ($companies as $row) { ?>
							<option value="<?=$row->id?>"><?=$row->name?></option>
						<? } ?>
						</select>
						<div class="review_field_input_error">Ошибка</div>
					</div>
				</div>
				<div class="review_field">
					<div class="review_field_title">
						Оценка
					</div>
					<div class="review_field_input">
						<select name="mark" id="mark">
							<option value="0">Нейтральная</option>
							<option value="1">Положительная</option>
							<option value="-1">Отрицательная</option>
						</select>
						<div class="review_field_input_error">Ошибка</div>
					</div>
				</div>
				<div class="review_field">
					<textarea name="message" id="message"></textarea>
					<div class="review_field_input_error">Ошибка</div>
				</div>
				<div class="review_submit">
					<span>Отправить</span>
				</div>
			</div>
		</div>
		<div class="content_review_list">
		<?
			foreach ($reviewes as $key => $row)
			{
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
			<div class="content_review_item <?=($row->mark == 1 ? '__good' : ($row->mark == -1 ? '__bad' : ''))?>">
				<div class="content_review_item_header">
					<span><?=$row->name?></span> | <i><?=$date[0]*1.0?> <?=$m?> <?=$date[2]?></i> | отзыв о фирме <span><a href="/<?=$this->city->simbol_name?>/company/<?=$row->company->url?>"><?=$row->company->name?></a></span>
				</div>
				<div class="content_review_item_content">
					<p><?=$row->text?></p>
				</div>
			</div>
		<?
				if ($key == 4)
				{
					?>
						<div class="start_market_between_tiz __review_bottom __gg">
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
						<div class="start_market_between_tiz __review_bottom">
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

<div class="popup_out __hidden">
	<div class="review_create_success __hidden">
		<p>Отзыв успешно добавлен</p>
		<div class="review_create_success_button">
			Закрыть
		</div>
	</div>
	<div class="review_create_fail __hidden">
		<p>Произошла ошибка<br />Попробуйте добавить отзыв еще раз</p>
		<div class="review_create_fail_button">
			Закрыть
		</div>
	</div>
</div>
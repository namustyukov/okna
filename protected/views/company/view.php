<?php
/* @var $this CompanyController */
/* @var $model Company */
$this->menu=array(
	array('label'=>'List Company', 'url'=>array('index')),
	array('label'=>'Create Company', 'url'=>array('create')),
	array('label'=>'Update Company', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Company', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Company', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/<?=$this->city->simbol_name?>"><?=$this->city->gorod?></a></li>
			<li><a href="/<?=$this->city->simbol_name?>/company/list">Производители окон</a></li>
			<li><?=$model->name?></li>
		</ul>
	</div>
	<div class="page_name">
		<h1><?=$model->name?> в <?=$this->city->gorode?></h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
		<div class="sidebar_company_view">
			<h2>ДОПОЛНИТЕЛЬНЫЕ ДАННЫЕ КОМПАНИИ <?=$model->name?> В <?=$this->city->gorode?></h2>
			<div class="sidebar_company_view_img">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$model->logo ? $model->logo : 'defineLogo.jpg'?>" alt="<?=$model->name?> в <?=$this->city->gorode?>" />
			</div>
			<ul>
				<? if (count($model->service)) { ?>
				<li>
					<a class="sidebar_company_view_service">Услуги (<?=count($model->service)?>)</a>
				</li>
				<? } ?>
				<? if (count($model->news)) { ?>
				<li>
					<a class="sidebar_company_view_news">Новости (<?=count($model->news)?>)</a>
				</li>
				<? } ?>
				<li>
					<a class="sidebar_company_view_review">
						<?=count($model->review) ? 'Отзывы ('.count($model->review).')' : 'Добавить отзыв'?>
					</a>
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
		<div class="content_company_view">
			<div class="company_view_shortinfo">
				<h3>ИНФОРМАЦИЯ О КОМПАНИИ</h3>
				<table cellpadding="0" cellspacing="0">
				<? if ($model->rating) { ?>
					<tr>
						<td class="shortinfo_left">Рейтинг</td>
						<td class="shortinfo_right">
							<div class="company_view_rating">
								<div class="company_view_rating_stars">
								<?
									$count_stars = 5 - floor($model->rating/ceil($companies_count/6));
									for ($j=0; $j < 5; $j++)
									{
										$class = '__stars_bad';
										if ($j < $count_stars)
											$class = '__stars_good';
										echo '<span class="'.$class.'"></span>';
									}
								?>
								</div>
								<div class="company_view_rating_text">
									<?=$model->rating?> из <?=$companies_count?>
								</div>
							</div>
						</td>
					</tr>
				<? } ?>
					<tr>
						<td class="shortinfo_left">Полное наименование</td>
						<td class="shortinfo_right"><?=$model->full_name?></td>
					</tr>
				<? if ($model->address) { ?>
					<tr>
						<td class="shortinfo_left">Адрес</td>
						<td class="shortinfo_right"><?=$model->address?></td>
					</tr>
				<? } ?>
				<? if ($model->phone) { ?>
					<tr>
						<td class="shortinfo_left">Телефон</td>
						<td class="shortinfo_right"><?=$model->phone?></td>
					</tr>
				<? } ?>
				<? if ($model->email) { ?>
					<tr>
						<td class="shortinfo_left">E-mail</td>
						<td class="shortinfo_right"><?=$model->email?></td>
					</tr>
				<? } ?>
				<? if ($model->worktime) { ?>
					<tr>
						<td class="shortinfo_left">Время работы </td>
						<td class="shortinfo_right"><?=$model->worktime?></td>
					</tr>
				<? } ?>
				<? if ($model->date_found) { ?>
					<tr>
						<td class="shortinfo_left">Дата основания</td>
						<td class="shortinfo_right"><?=$model->date_found?></td>
					</tr>
				<? } ?>
				<? if ($model->site) { ?>
					<tr>
						<td class="shortinfo_left">Сайт</td>
						<td class="shortinfo_right __good">
						<?php
							if ($model->id == 5595)
							{
								echo '<a target="_blank" class="out_link" data-url="'.$model->site.'">'.$model->site.'</a>, ';
								echo '<a target="_blank" class="out_link" data-url="http://первыйоконныйдвор.рф/">http://первыйоконныйдвор.рф/</a>';
							}
							else
								echo $model->site;
						?>
						</td>
					</tr>
				<? } ?>
				<? if ($model->certificate) { ?>
					<tr>
						<td class="shortinfo_left">Сертификаты соответствия</td>
						<td class="shortinfo_right __good"><?=$model->certificate?></td>
					</tr>
				<? } ?>
				<? if ($model->guarantee) { ?>
					<tr>
						<td class="shortinfo_left">Гарантия</td>
						<td class="shortinfo_right __good"><?=$model->guarantee?></td>
					</tr>
				<? } ?>
				<? if ($model->payment) { ?>
					<tr>
						<td class="shortinfo_left">Способы оплаты</td>
						<td class="shortinfo_right"><?=$model->payment?></td>
					</tr>
				<? } ?>
				<? if ($model->online) { ?>
					<tr>
						<td class="shortinfo_left">Онлайн заказ</td>
						<td class="shortinfo_right __good"><?=$model->online?></td>
					</tr>
				<? } ?>
				<? if ($model->price) { ?>
					<tr>
						<td class="shortinfo_left">Цена</td>
						<td class="shortinfo_right"><?=$model->price?></td>
					</tr>
				<? } ?>
				<? if ($model->promo) { ?>
					<tr>
						<td class="shortinfo_left">Акции</td>
						<td class="shortinfo_right __good"><?=$model->promo?></td>
					</tr>
				<? } ?>
				<? if ($model->production_way) { ?>
					<tr>
						<td class="shortinfo_left">Способ производства</td>
						<td class="shortinfo_right"><?=$model->production_way?></td>
					</tr>
				<? } ?>
				</table>
			<?php
				if (0) { // для фильтра по СЕО
			?>
				<p>OKNAORG.RU подобрал наиболее значимые показатели предприятия <?=$model->name?> в <?=$this->city->gorode?>. На их основе дана оценка компании и ее рейтинг среди других производителей оконных конструкций.</p>
			<?php } ?>
			</div>
			<? foreach ($model->service as $service) { ?>
			<div class="content_company_service">
				<h3><?=$service->service->text?></h3>
				<? foreach ($service->products as $products) { ?>
				<div class="content_company_service_row">
					<p><?=$products->text?></p>
					<ul>
						<?
							foreach ($products->ranges as $ranges)
							{
								echo "<li>".$ranges->text."</li>";
							}
						?>
					</ul>
				</div>
				<? } ?>
			</div>
			<? } ?>
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
			<div class="content_company_review">
				<h3>ОТЗЫВЫ</h3>
				<div class="review_add">
					<div class="review_add_button <?=!count($model->review) ? '__active' : ''?>">
						<span>Добавить отзыв</span>
					</div>
					<div class="review_form <?=!count($model->review) ? '__show' : ''?>">
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
								<select name="company" id="company" disabled="disabled">
									<option value="<?=$model->id?>"><?=$model->name?></option>
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
					foreach ($model->review as $row)
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
							<span><?=$row->name?></span> | <?=$date[0]*1.0?> <?=$m?> <?=$date[2]?> | отзыв о фирме <span><?=$row->company->name?></span>
						</div>
						<div class="content_review_item_content">
							<p><?=$row->text?></p>
						</div>
					</div>
				<? } ?>
				</div>
			</div>
		<?php if ($about) { ?>
			<div class="content_company_about">
				<h3>ОПИСАНИЕ ДЕЯТЕЛЬНОСТИ ФИРМЫ «<?=$model->name?>»</h3>
				<?=$about?>
			</div>
		<?php } ?>
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
<div class="header_name">
	<div class="page_name">
		<h1>ОКНАОРГ.РУ - интернет-портал о пластиковых окнах в России</h1>
	</div>
</div>
<div class="conteiner">
	<div class="sidebar __right">
		<div class="sidebar_news_view">
			<div class="sidebar_news_view_another __article">
				<h2>ПОЛЕЗНАЯ ИНФОРМАЦИЯ</h2>
				<ul>
				<?php foreach ($page_list as $row) { ?>
					<li>
						<a href="/page/<?=$row->url?>"><?=$row->title?></a>
					</li>
				<?php } ?>
				</ul>
				<div class="news_href">
					<a href="/page/list">Список всех статей</a>
				</div>
			</div>
		</div>
		<div class="sidebar_market_href_tiz __gg">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- oknaorg sidebar стартовая -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:300px;height:600px"
			     data-ad-client="ca-pub-9040033498726551"
			     data-ad-slot="2966674823"></ins>
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
		<div class="content_index">
			<div class="content_index_statistics">
				<h2>Общая статистика проекта</h2>
				<div class="page-description">
					<p>База данных насчитывает <?=$count_city?> города России, а так же порядка <?=$count_company?> предприятий, связанных с производством пластиковых, деревянных и алюминиевых окон, а так же с их установкой и ремонтом. Мы составили <a href="/<?=$this->city->simbol_name?>/company/list">рейтинг компаний</a>, основанный на более 10 показателей, среди которых:</p>
					<ul>
						<li>отзывы клиентов</li>
						<li>стоимость окон</li>
						<li>предоставляемые услуги</li>
						<li>наличие сертификатов ГОСТ</li>
						<li>наличие акций и скидок</li>
						<li>качество и гарантии предоставляемых услуг</li>
					</ul>
					<p>Все показатели представлены на странице компании.</p>
					<p>Большое внимание уделено актуализации информации. В связи с этим в разделе <a href="/<?=$this->city->simbol_name?>/news/list">Новости</a> мы ежедневно следим за изменениями, происшедшими в компаниях города.</p>
					<p>Если у вас есть дополнительные пожелания к проекту, мы всегда готовы их рассмотреть.</p>
				</div>
			</div>
			<div class="content_index_section">
				<h3>Разделы портала</h3>
				<ul>
					<li class="__city">
						<a href="/city/list">
							Города
							<span><?=$count_city?></span>
						</a>
					</li>
					<li class="__company">
						<a href="/<?=$this->city->simbol_name?>/company/list">
							Компании
							<span><?=$count_company?></span>
						</a>
					</li>
					<li class="__news">
						<a href="/<?=$this->city->simbol_name?>/news/list">
							Новости
							<span><?=$count_news?></span>
						</a>
					</li>
					<li class="__promo">
						<a href="/<?=$this->city->simbol_name?>/promo/list">
							Акции и скидки
							<span><?=$count_promo?></span>
						</a>
					</li>
					<li class="__prices">
						<a href="/<?=$this->city->simbol_name?>/prices/list">
							Цены
							<span><?=$count_price?></span>
						</a>
					</li>
					<li class="__review">
						<a href="/<?=$this->city->simbol_name?>/review/list">
							Отзывы
							<span><?=$count_review?></span>
						</a>
					</li>
				</ul>
			</div>
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
			<? if ($this->show_market && 0) { ?>
			<div class="start_market_between_tiz">
				<script>(function(e){var t="DIV_DA_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="directadvert-block directadvert-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_directadvert){loaded_blocks_directadvert=[]; function n(){var e=loaded_blocks_directadvert.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.directadvert.ru/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_directadvert.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_directadvert.push({adp_id:e,div:t})})(536343)</script>
			</div>
			<? } ?>
			<div class="content_index_city">
				<h3>СПИСОК ГОРОДОВ</h3>
				<div class="content_index_city_list">
				<?
					if (1)
					{
				?>
						<div class="content_index_city_col">
							<div class="content_index_city_col_row">
								<a href="/barnaul">Барнаул</a>
								<span class="__company">Компаний <b>38</b></span>
								<span class="__news">Новостей <b>58</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4920</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/belgorod">Белгород</a>
								<span class="__company">Компаний <b>44</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>1</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4751</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/vladivostok">Владивосток</a>
								<span class="__company">Компаний <b>76</b></span>
								<span class="__news">Новостей <b>193</b></span>
								<span class="__review">Отзывов <b>8</b></span>
								<span class="__price">Цена за 1 м. кв. <b>6322</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/volgograd">Волгоград</a>
								<span class="__company">Компаний <b>60</b></span>
								<span class="__news">Новостей <b>171</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4723</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/voronezh">Воронеж</a>
								<span class="__company">Компаний <b>94</b></span>
								<span class="__news">Новостей <b>227</b></span>
								<span class="__review">Отзывов <b>5</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4675</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/dzerzhinsk">Дзержинск</a>
								<span class="__company">Компаний <b>33</b></span>
								<span class="__news">Новостей <b>58</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5702</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/ekaterinburg">Екатеринбург</a>
								<span class="__company">Компаний <b>43</b></span>
								<span class="__news">Новостей <b>272</b></span>
								<span class="__review">Отзывов <b>5</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5249</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/ivanovo">Иваново</a>
								<span class="__company">Компаний <b>44</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>1</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5761</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/izhevsk">Ижевск</a>
								<span class="__company">Компаний <b>78</b></span>
								<span class="__news">Новостей <b>193</b></span>
								<span class="__review">Отзывов <b>2</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4889</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/irkutsk">Иркутск</a>
								<span class="__company">Компаний <b>81</b></span>
								<span class="__news">Новостей <b>227</b></span>
								<span class="__review">Отзывов <b>6</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4952</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/kazan">Казань</a>
								<span class="__company">Компаний <b>65</b></span>
								<span class="__news">Новостей <b>193</b></span>
								<span class="__review">Отзывов <b>10</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4814</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/kirov">Киров</a>
								<span class="__company">Компаний <b>34</b></span>
								<span class="__news">Новостей <b>58</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4868</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/krasnodar">Краснодар</a>
								<span class="__company">Компаний <b>108</b></span>
								<span class="__news">Новостей <b>220</b></span>
								<span class="__review">Отзывов <b>4</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4692</b> р.</span>
							</div>
						</div>
						<div class="content_index_city_col">
							<div class="content_index_city_col_row">
								<a href="/krasnoyarsk">Красноярск</a>
								<span class="__company">Компаний <b>44</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4925</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/lipetsk">Липецк</a>
								<span class="__company">Компаний <b>44</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5672</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/msk">Москва</a>
								<span class="__company">Компаний <b>1082</b></span>
								<span class="__news">Новостей <b>293</b></span>
								<span class="__review">Отзывов <b>28</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5651</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/nn">Нижний Новгород</a>
								<span class="__company">Компаний <b>252</b></span>
								<span class="__news">Новостей <b>227</b></span>
								<span class="__review">Отзывов <b>2</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4835</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/novokuz">Новокузнецк</a>
								<span class="__company">Компаний <b>56</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>1</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4950</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/novosibirsk">Новосибирск</a>
								<span class="__company">Компаний <b>118</b></span>
								<span class="__news">Новостей <b>227</b></span>
								<span class="__review">Отзывов <b>5</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4929</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/omsk">Омск</a>
								<span class="__company">Компаний <b>68</b></span>
								<span class="__news">Новостей <b>193</b></span>
								<span class="__review">Отзывов <b>2</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4980</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/orenburg">Оренбург</a>
								<span class="__company">Компаний <b>63</b></span>
								<span class="__news">Новостей <b>293</b></span>
								<span class="__review">Отзывов <b>11</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5301</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/perm">Пермь</a>
								<span class="__company">Компаний <b>61</b></span>
								<span class="__news">Новостей <b>171</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5329</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/rostov-na-donu">Ростов-на-Дону</a>
								<span class="__company">Компаний <b>128</b></span>
								<span class="__news">Новостей <b>227</b></span>
								<span class="__review">Отзывов <b>5</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4717</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/samara">Самара</a>
								<span class="__company">Компаний <b>133</b></span>
								<span class="__news">Новостей <b>293</b></span>
								<span class="__review">Отзывов <b>2</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4845</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/spb">Санкт-Петербург</a>
								<span class="__company">Компаний <b>525</b></span>
								<span class="__news">Новостей <b>291</b></span>
								<span class="__review">Отзывов <b>17</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4794</b> р.</span>
							</div>
						</div>
						<div class="content_index_city_col">							
							<div class="content_index_city_col_row">
								<a href="/saratov">Саратов</a>
								<span class="__company">Компаний <b>85</b></span>
								<span class="__news">Новостей <b>227</b></span>
								<span class="__review">Отзывов <b>4</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4876</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/smolensk">Смоленск</a>
								<span class="__company">Компаний <b>61</b></span>
								<span class="__news">Новостей <b>171</b></span>
								<span class="__review">Отзывов <b>1</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5664</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/sochi">Сочи</a>
								<span class="__company">Компаний <b>29</b></span>
								<span class="__news">Новостей <b>293</b></span>
								<span class="__review">Отзывов <b>8</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4767</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/stavropol">Ставрополь</a>
								<span class="__company">Компаний <b>77</b></span>
								<span class="__news">Новостей <b>171</b></span>
								<span class="__review">Отзывов <b>4</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4689</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/tomsk">Томск</a>
								<span class="__company">Компаний <b>55</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4983</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/tula">Тула</a>
								<span class="__company">Компаний <b>33</b></span>
								<span class="__news">Новостей <b>58</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5675</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/tumen">Тюмень</a>
								<span class="__company">Компаний <b>53</b></span>
								<span class="__news">Новостей <b>116</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4961</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/ulyanovsk">Ульяновск</a>
								<span class="__company">Компаний <b>36</b></span>
								<span class="__news">Новостей <b>58</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4877</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/ufa">Уфа</a>
								<span class="__company">Компаний <b>59</b></span>
								<span class="__news">Новостей <b>293</b></span>
								<span class="__review">Отзывов <b>2</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5258</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/chelyabinsk">Челябинск</a>
								<span class="__company">Компаний <b>72</b></span>
								<span class="__news">Новостей <b>193</b></span>
								<span class="__review">Отзывов <b>3</b></span>
								<span class="__price">Цена за 1 м. кв. <b>4828</b> р.</span>
							</div>
							<div class="content_index_city_col_row">
								<a href="/yaroslavl">Ярославль</a>
								<span class="__company">Компаний <b>36</b></span>
								<span class="__news">Новостей <b>58</b></span>
								<span class="__review">Отзывов <b>0</b></span>
								<span class="__price">Цена за 1 м. кв. <b>5707</b> р.</span>
							</div>
						</div>
				<?
					}
					else
					{
				?>
						<div class="content_index_city_col">
					<?
						$count = count($cities);
						$sch = 1;
						for ($i=0; $i < $count; $i++)
						{
					?>
							<div class="content_index_city_col_row">
								<a href="/<?=$cities[$i]->simbol_name?>"><?=$cities[$i]->gorod?></a>
								<span class="__company">Компаний <b><?=count($cities[$i]->company)?></b></span>
								<span class="__news">Новостей <b><?=count($cities[$i]->news)?></b></span>
								<span class="__review">Отзывов <b><?=count($cities[$i]->reviews)?></b></span>
								<span class="__price">Цена за 1 м. кв. <b><?=$cities[$i]->region->price[0]->price + $cities[$i]->id?></b> р.</span>
							</div>
					<?
							if ($i == floor($count*$sch/3) && $sch < 3)
							{
								echo '</div><div class="content_index_city_col">';
								$sch++;
							}
						}
					?>
						</div>
				<? } ?>
				</div>
				<div class="content_index_city_show">
					<a href="/city/list">Показать весь список городов</a>
				</div>
			</div>
		</div>
	</div>
</div>
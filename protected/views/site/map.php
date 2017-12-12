<div class="header_name">
	<div class="page_name">
		<h1>Карта проекта ОКНАОРГ.РУ</h1>
	</div>
</div>
<div class="conteiner">
	<div class="content">
		<div class="map-level-1">
			<a href="/">Главная страница</a>
		</div>
		<div class="map-level-2">
			<a href="/city/list">Список городов</a>
		</div>
		<? foreach ($city as $row) { ?>
		<div class="map-level-2">
			<a href="/<?=$row->simbol_name?>"><?=$row->gorod?></a>
			<div class="map-level-3">
				<div class="map-level-3-col">
					<a href="/<?=$row->simbol_name?>/company/list">Компании</a>
				</div>
				<div class="map-level-3-col">
					<a href="/<?=$row->simbol_name?>/news/list">Новости</a>
				</div>
				<div class="map-level-3-col">
					<a href="/<?=$row->simbol_name?>/prices/list">Цены</a>
				</div>
				<div class="map-level-3-col">
					<a href="/<?=$row->simbol_name?>/promo/list">Акции и скидки</a>
				</div>
				<div class="map-level-3-col">
					<a href="/<?=$row->simbol_name?>/review/list">Отзывы</a>
				</div>
			</div>
			<div class="map-level-3">
				<h4>Список компаний из ТОП-10</h4>
				<?php
					for ($i=0; $i < 10; $i++)
					{
						if ($row->company[$i])
						{
				?>
					<div class="map-level-3-row">
						<a href="/<?=$row->simbol_name?>/company/<?=$row->company[$i]->url?>"><?=$row->company[$i]->name?></a>
					</div>
				<?php
						}
					}
				?>
			</div>
		</div>
		<? } ?>
		<div class="map-level-2">
			<a href="/page/list">Список статей</a>
		</div>
		<?php foreach ($page_list as $row) { ?>
		<div class="map-level-3">
			<a href="/page/<?=$row->url?>"><?=$row->title?></a>
		</div>
		<?php } ?>
	</div>
</div>
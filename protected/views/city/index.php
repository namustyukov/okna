<?php
$this->menu=array(
	array('label'=>'Create Company', 'url'=>array('create')),
	array('label'=>'Manage Company', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li>Города</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Городская сеть проекта OKNAORG.RU</h1>
	</div>
</div>
<div class="conteiner">
	<div class="city_list_column">
		<div class="city_list_column_col">
	<?
		$count = count($cities);
		$sch = 1;
		for ($i=0; $i < $count; $i++)
		{
	?>
			<div class="city_list_column_col_row">
				<a href="/<?=$cities[$i]->simbol_name?>"><?=$cities[$i]->gorod?></a>
			</div>
	<?
			if ($i == floor($count*$sch/4) && $sch < 4)
			{
				echo '</div><div class="city_list_column_col">';
				$sch++;
			}
		}
	?>
		</div>
	</div>
</div>
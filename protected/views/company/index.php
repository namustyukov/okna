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
			<li><a href="/<?=$this->city->simbol_name?>"><?=$this->city->gorod?></a></li>
			<li>Производители окон</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Рейтинг фирм по продаже пластиковых окон в <?=$this->city->gorode?></h1>
	</div>
</div>
<div class="conteiner">
	<div class="company_list_column">
		<div class="company_list_column_col">
	<?
		$count = count($companies);
		$sch = 1;
		for ($i=0; $i < $count; $i++)
		{
	?>
			<div class="company_list_column_col_row">
				<div class="company_list_item_img">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$companies[$i]->logo ? $companies[$i]->logo : 'defineLogo.jpg'?>" alt="<?=$companies[$i]->name?> в <?=$this->city->gorode?>" />
				</div>
				<div class="company_list_item_info">
					<div class="company_list_item_title">
						<a href="/<?=$this->city->simbol_name?>/company/<?=$companies[$i]->url?>"><?=$companies[$i]->name?></a>
					</div>
					<?
						if ($companies[$i]->rating)
						{ 
							$count_stars = 5 - floor($companies[$i]->rating/ceil($count/6));
							echo '<div class="company_list_item_rating_stars">';
							for ($j=0; $j < 5; $j++)
							{
								$class = '__stars_bad';
								if ($j < $count_stars)
									$class = '__stars_good';
								echo '<span class="'.$class.'"></span>';
							}
							echo '</div>';
					?>
						<div class="company_list_item_rating_text">
							Рейтинг <?=$companies[$i]->rating?> из <?=$count?>
						</div>
					<?
						}
					?>
				</div>
			</div>
	<?
			if ($i == floor($count*$sch/3) && $sch < 3)
			{
				echo '</div><div class="company_list_column_col">';
				$sch++;
			}
		}
	?>
		</div>
	</div>
</div>
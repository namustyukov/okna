<?php
/* @var $this CompanyNewController */
/* @var $model CompanyNew */

$this->breadcrumbs=array(
	'Company News'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CompanyNew', 'url'=>array('index')),
	array('label'=>'Create CompanyNew', 'url'=>array('create')),
	array('label'=>'Update CompanyNew', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompanyNew', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompanyNew', 'url'=>array('admin')),
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
		<h1><?=$model->name?></h1>
	</div>
</div>
<div class="company-new-info">
<?php if ($model->is_accept) { ?>
	<h2>Компания <?=$model->name?> размещена на сайте.</h2>
	<?php if ($model->insite->url) { ?>
		<p>Ссылка компании - <a href="/<?=$this->city->simbol_name?>/company/<?=$model->insite->url?>"><?=$model->insite->name?></a></p>
	<?php } ?>
<?php }else{ ?>
	<h2>Информация проверяется.</h2>
	<p>После проверки сайт будет размещен на сайте. На почту <strong><?=$model->user_email?></strong> к вам придет уведомление.</p>
	<p>
		<a class="__edit" href="/companyNew/update?id=<?=$model->id?>">
			Редактировать
		</a>
		<a class="__delete" href="/companyNew/delete?id=<?=$model->id?>">
			Удалить
		</a>
	</p>
<?php } ?>
</div>
<div class="conteiner">
	<div class="sidebar __right">
		<div class="sidebar_company_view">
			<h2>ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ О КОМПАНИИ <?=$model->name?> В <?=$this->city->gorode?></h2>
			<div class="sidebar_company_view_img">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$model->logo ? $model->logo : 'defineLogo.jpg'?>" alt="<?=$model->name?> в <?=$this->city->gorode?>" />
			</div>
			<ul>
				<li>
					<small>Полное наименование</small>
					<span><?=$model->full_name?></span>
				</li>
				<? if ($model->site) { ?>
				<li>
					<small>Сайт</small>
					<span><?=$model->site?></span>
				</li>
				<? } ?>
				<? if ($model->address) { ?>
				<li>
					<small>Адрес</small>
					<span><?=$model->address?></span>
				</li>
				<? } ?>
				<? if ($model->phone) { ?>
				<li>
					<small>Телефон</small>
					<span><?=$model->phone?></span>
				</li>
				<? } ?>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="content_company_view">
			<div class="company_view_shortinfo">
				<h3>ИНФОРМАЦИЯ О КОМПАНИИ</h3>
				<table cellpadding="0" cellspacing="0">
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
								echo '<a target="_blank" href="'.$model->site.'">'.$model->site.'</a>, ';
								echo '<a target="_blank" href="http://первыйоконныйдвор.рф/">http://первыйоконныйдвор.рф/</a>';
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
			</div>
			<div class="content_company_about">
				<h3>ИНФОРМАЦИЯ О КОМПАНИИ «<?=$model->name?>»</h3>
				<?=$model->about?>
			</div>
			<!--Услуги, Общая оценка, Плюсы, Минусы, Отзывы, Общий текст, Похожие компании -->
		</div>
	</div>
</div>
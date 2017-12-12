<?php
/* @var $this CompanyNewController */
/* @var $model CompanyNew */

$this->breadcrumbs=array(
	'Company News'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompanyNew', 'url'=>array('index')),
	array('label'=>'Create CompanyNew', 'url'=>array('create')),
	array('label'=>'View CompanyNew', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompanyNew', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li>Редактировать</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Редактировать компанию "<?=$model->name?>"</h1>
	</div>
</div>
<div class="conteiner">
	<div class="content">
		<div class="content_company_add">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>
<?php
/* @var $this CompanyNewController */
/* @var $model CompanyNew */
$this->menu=array(
	array('label'=>'List CompanyNew', 'url'=>array('index')),
	array('label'=>'Manage CompanyNew', 'url'=>array('admin')),
);
?>

<div class="header_name">
	<div class="breadcrump">
		<ul>
			<li><a href="/">Главная</a></li>
			<li>Добавление компании</li>
		</ul>
	</div>
	<div class="page_name">
		<h1>Добавление компании</h1>
	</div>
</div>
<div class="conteiner">
	<div class="content">
		<div class="content_company_add">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>
<?php
/* @var $this CompanyNewController */
/* @var $model CompanyNew */

$this->breadcrumbs=array(
	'Company News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompanyNew', 'url'=>array('index')),
	array('label'=>'Manage CompanyNew', 'url'=>array('admin')),
);
?>

<h1>Create CompanyNew</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
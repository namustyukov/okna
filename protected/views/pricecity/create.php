<?php
/* @var $this PricecityController */
/* @var $model Pricecity */

$this->breadcrumbs=array(
	'Pricecities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pricecity', 'url'=>array('index')),
	array('label'=>'Manage Pricecity', 'url'=>array('admin')),
);
?>

<h1>Create Pricecity</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Regions', 'url'=>array('admin')),
);
?>

<h1>Create Region</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
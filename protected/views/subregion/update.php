<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Region', 'url'=>array('create')),
	array('label'=>'View Region', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Regions', 'url'=>array('admin')),
);
?>

<h1>Update Region <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
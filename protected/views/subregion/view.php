<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Region', 'url'=>array('create')),
	array('label'=>'Update Region', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Region', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Regions', 'url'=>array('admin')),
);
?>

<h1>View Region <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>

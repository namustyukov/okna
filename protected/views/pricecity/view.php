<?php
/* @var $this PricecityController */
/* @var $model Pricecity */

$this->breadcrumbs=array(
	'Pricecities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pricecity', 'url'=>array('index')),
	array('label'=>'Create Pricecity', 'url'=>array('create')),
	array('label'=>'Update Pricecity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pricecity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pricecity', 'url'=>array('admin')),
);
?>

<h1>View Pricecity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name' => 'Дата создания',
			'value' => date("d.m.Y", $model->date_create),
        ),
		'price',
		'diff',
		'price_key',
		'diff_key',
		array(
			'label' => 'Регион',
			'value' => $model->region->name,
        ),
	),
)); ?>

<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'Update City', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete City', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage City', 'url'=>array('admin')),
);
?>

<h1>View City #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gorod',
		'goroda',
		'gorode',
		'gorodu',
		'kakih',
		'kakie',
		'kakimi',
		'kakuyu',
		'kakoy',
		'kakom',
		'kakaya',
		'simbol_name',
		array(
			'label' => 'Регион',
			'value' => $model->region->name,
        ),
		array(
			'label' => 'Область',
			'value' => $model->sub_region->name,
        ),
		'koord_x',
		'koord_y',
		'date_modify',
	),
)); ?>

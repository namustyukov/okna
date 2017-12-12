<?php
/* @var $this LikesController */
/* @var $model Likes */

$this->breadcrumbs=array(
	'Likes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Likes', 'url'=>array('index')),
	array('label'=>'Create Likes', 'url'=>array('create')),
	array('label'=>'Update Likes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Likes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Likes', 'url'=>array('admin')),
);
?>

<h1>View Likes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'news_id',
		'mean',
		'add_time',
	),
)); ?>

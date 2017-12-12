<?php
/* @var $this LikesController */
/* @var $model Likes */

$this->breadcrumbs=array(
	'Likes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Likes', 'url'=>array('index')),
	array('label'=>'Create Likes', 'url'=>array('create')),
	array('label'=>'View Likes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Likes', 'url'=>array('admin')),
);
?>

<h1>Update Likes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
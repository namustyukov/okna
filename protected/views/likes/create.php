<?php
/* @var $this LikesController */
/* @var $model Likes */

$this->breadcrumbs=array(
	'Likes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Likes', 'url'=>array('index')),
	array('label'=>'Manage Likes', 'url'=>array('admin')),
);
?>

<h1>Create Likes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
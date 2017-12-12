<?php
/* @var $this LikesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Likes',
);

$this->menu=array(
	array('label'=>'Create Likes', 'url'=>array('create')),
	array('label'=>'Manage Likes', 'url'=>array('admin')),
);
?>

<h1>Likes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

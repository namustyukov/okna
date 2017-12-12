<?php
/* @var $this PricecityController */
/* @var $model Pricecity */

$this->breadcrumbs=array(
	'Pricecities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pricecity', 'url'=>array('index')),
	array('label'=>'Create Pricecity', 'url'=>array('create')),
	array('label'=>'View Pricecity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pricecity', 'url'=>array('admin')),
);
?>

<h1>Update Pricecity <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
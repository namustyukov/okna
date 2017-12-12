<?php
/* @var $this PricecityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pricecities',
);

$this->menu=array(
	array('label'=>'Create Pricecity', 'url'=>array('create')),
	array('label'=>'Manage Pricecity', 'url'=>array('admin')),
);
?>

<h1>Pricecities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

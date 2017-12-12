<?php
/* @var $this CompanyNewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Company News',
);

$this->menu=array(
	array('label'=>'Create CompanyNew', 'url'=>array('create')),
	array('label'=>'Manage CompanyNew', 'url'=>array('admin')),
);
?>

<h1>Company News</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

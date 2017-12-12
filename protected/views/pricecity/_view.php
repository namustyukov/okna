<?php
/* @var $this PricecityController */
/* @var $data Pricecity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diff')); ?>:</b>
	<?php echo CHtml::encode($data->diff); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_key')); ?>:</b>
	<?php echo CHtml::encode($data->price_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diff_key')); ?>:</b>
	<?php echo CHtml::encode($data->diff_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region_id')); ?>:</b>
	<?php echo CHtml::encode($data->region_id); ?>
	<br />


</div>
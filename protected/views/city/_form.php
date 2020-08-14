<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gorod'); ?>
		<?php echo $form->textField($model,'gorod',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gorod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'goroda'); ?>
		<?php echo $form->textField($model,'goroda',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'goroda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gorode'); ?>
		<?php echo $form->textField($model,'gorode',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gorode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gorodu'); ?>
		<?php echo $form->textField($model,'gorodu',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gorodu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakih'); ?>
		<?php echo $form->textField($model,'kakih',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakih'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakie'); ?>
		<?php echo $form->textField($model,'kakie',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakimi'); ?>
		<?php echo $form->textField($model,'kakimi',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakimi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakuyu'); ?>
		<?php echo $form->textField($model,'kakuyu',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakuyu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakoy'); ?>
		<?php echo $form->textField($model,'kakoy',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakoy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakom'); ?>
		<?php echo $form->textField($model,'kakom',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakaya'); ?>
		<?php echo $form->textField($model,'kakaya',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakaya'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'simbol_name'); ?>
		<?php echo $form->textField($model,'simbol_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'simbol_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'region_id',
					CHtml::listData(Region::model()->findAll(array('order'=>'id')), 'id', 'name'),
                    array(
                      'prompt' => 'Не указано',
                      'options' => array(
                            $model->region_id=>array('selected'=>true),
                      ))
                    );
                ?>
		<?php echo $form->error($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_region_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'sub_region_id',
					CHtml::listData(SubRegion::model()->findAll(array('order'=>'id')), 'id', 'name'),
                    array(
                      'prompt' => 'Не указано',
                      'options' => array(
                            $model->sub_region_id=>array('selected'=>true),
                      ))
                    );
                ?>
		<?php echo $form->error($model,'sub_region_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
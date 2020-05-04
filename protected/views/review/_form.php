<?php
/* @var $this ReviewController */
/* @var $model Review */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'review-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'city_id',
					CHtml::listData(City::model()->findAll(array('order'=>'gorod')), 'id', 'gorod'),
                    array(
                      'options' => array(
                            $model->city_id=>array('selected'=>true),
                      ))
                    );
                ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'company_id',
			News::getCompanyOptions(),
			array(
			  'options' => array(
					$model->company_id=>array('selected'=>true),
			  ))
			);
		?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'mark'); ?>
		<?php echo CHtml::activeDropDownList($model, 'mark',
			Review::$MARK_LIST,
			array(
			  'options' => array(
					$model->mark=>array('selected'=>true),
			  ))
			);
		?>
		<?php echo $form->error($model,'mark'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
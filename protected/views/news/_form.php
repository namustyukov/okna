<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
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
	<!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo CHtml::activeDropDownList($model, 'type',
			array(''=>'', 'detail'=>'Детальная новость', 'update'=>'Изменения в записи'),
			array(
			  'options' => array(
					$model->type=>array('selected'=>true),
			  ))
			);
		?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	 -->
	<div class="row">
		<?php echo $form->labelEx($model,'preview'); ?>
		<?php echo $form->textArea($model,'preview',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'preview'); ?>
	</div>
<!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'view_count'); ?>
		<?php echo $form->textField($model,'view_count',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'view_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url_info'); ?>
		<?php echo $form->textField($model,'url_info',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'url_info'); ?>
	</div>
 -->
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
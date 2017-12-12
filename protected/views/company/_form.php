<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
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
		<?php echo $form->labelEx($model,'full_name'); ?>
		<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'worktime'); ?>
		<?php echo $form->textField($model,'worktime',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'worktime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'online'); ?>
		<?php echo $form->textField($model,'online',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'online'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_found'); ?>
		<?php echo $form->textField($model,'date_found',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'date_found'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'certificate'); ?>
		<?php echo $form->textField($model,'certificate',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'certificate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guarantee'); ?>
		<?php echo $form->textField($model,'guarantee',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'guarantee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<?php echo $form->textField($model,'payment',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'promo'); ?>
		<?php echo $form->textField($model,'promo',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'promo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'production_way'); ?>
		<?php echo $form->textField($model,'production_way',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'production_way'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'logo'); ?><br />
		<?php echo CHtml::activeFileField($model,'logo'); ?>
		<?php echo CHtml::error($model,'logo'); ?>
		<?
			if ($model->logo)
			{
				echo "<h4>Текущая картинка</h4>";
				echo '<img src="'.Yii::app()->request->baseUrl.'/img/'.$model->logo.'"';
			}
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'donor_site'); ?>
		<?php echo $form->textField($model,'donor_site',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'donor_site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'koord_x'); ?>
		<?php echo $form->textField($model,'koord_x',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'koord_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'koord_y'); ?>
		<?php echo $form->textField($model,'koord_y',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'koord_y'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this PricecityController */
/* @var $model Pricecity */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pricecity-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
			$time = strtotime(date("Y-m-01"));
		?>
		<?php echo $form->labelEx($model,'date_create'); ?>
		<?php echo CHtml::activeDropDownList($model, 'date_create',
			array(
				strtotime('-12 month', $time) => date("Y-m-d", strtotime('-12 month', $time)),
				strtotime('-11 month', $time) => date("Y-m-d", strtotime('-11 month', $time)),
				strtotime('-10 month', $time) => date("Y-m-d", strtotime('-10 month', $time)),
				strtotime('-9 month', $time) => date("Y-m-d", strtotime('-9 month', $time)),
				strtotime('-8 month', $time) => date("Y-m-d", strtotime('-8 month', $time)),
				strtotime('-7 month', $time) => date("Y-m-d", strtotime('-7 month', $time)),
				strtotime('-6 month', $time) => date("Y-m-d", strtotime('-6 month', $time)),
				strtotime('-5 month', $time) => date("Y-m-d", strtotime('-5 month', $time)),
				strtotime('-4 month', $time) => date("Y-m-d", strtotime('-4 month', $time)),
				strtotime('-3 month', $time) => date("Y-m-d", strtotime('-3 month', $time)),
				strtotime('-2 month', $time) => date("Y-m-d", strtotime('-2 month', $time)),
				strtotime('-1 month', $time) => date("Y-m-d", strtotime('-1 month', $time)),
				strtotime('-0 month', $time) => date("Y-m-d", strtotime('-0 month', $time)),
			),
            array(
                'options' => array(
                    $model->date_create=>array('selected'=>true),
                )
            )
		); ?>
		<?php echo $form->error($model,'date_create'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diff'); ?>
		<?php echo $form->textField($model,'diff'); ?>
		<?php echo $form->error($model,'diff'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_key'); ?>
		<?php echo $form->textField($model,'price_key'); ?>
		<?php echo $form->error($model,'price_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diff_key'); ?>
		<?php echo $form->textField($model,'diff_key'); ?>
		<?php echo $form->error($model,'diff_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'region_id',
					CHtml::listData(Region::model()->findAll(array('order'=>'name')), 'id', 'name'),
                    array(
                      'options' => array(
                            $model->region_id=>array('selected'=>true),
                      ))
                    );
                ?>
		<?php echo $form->error($model,'region_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
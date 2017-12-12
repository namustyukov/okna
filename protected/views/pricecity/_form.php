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
		<?php echo $form->labelEx($model,'date_create'); ?>
		<?php echo CHtml::activeDropDownList($model, 'date_create',
					array(
						mktime( 0, 0, 0, 6, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 6, 01, 2017 )),
						mktime( 0, 0, 0, 7, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 7, 01, 2017 )),
						mktime( 0, 0, 0, 8, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 8, 01, 2017 )),
						mktime( 0, 0, 0, 9, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 9, 01, 2017 )),
						mktime( 0, 0, 0, 10, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 10, 01, 2017 )),
						mktime( 0, 0, 0, 11, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 11, 01, 2017 )),
						mktime( 0, 0, 0, 12, 01, 2017 ) => date("Y-m-d", mktime( 0, 0, 0, 12, 01, 2017 )),
						mktime( 0, 0, 0, 1, 01, 2018 ) => date("Y-m-d", mktime( 0, 0, 0, 1, 01, 2018 )),
						mktime( 0, 0, 0, 2, 01, 2018 ) => date("Y-m-d", mktime( 0, 0, 0, 2, 01, 2018 )),
						mktime( 0, 0, 0, 3, 01, 2018 ) => date("Y-m-d", mktime( 0, 0, 0, 3, 01, 2018 )),
					),
                    array(
                      'options' => array(
                            $model->date_create=>array('selected'=>true),
                      ))
                    );
                ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
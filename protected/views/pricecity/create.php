<?php
/* @var $this PricecityController */
/* @var $model Pricecity */

$this->breadcrumbs=array(
	'Pricecities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pricecity', 'url'=>array('index')),
	array('label'=>'Manage Pricecity', 'url'=>array('admin')),
);
?>

<h1>Create Pricecity</h1>


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
						mktime( 0, 0, 0, 4, 01, 2018 ) => date("Y-m-d", mktime( 0, 0, 0, 4, 01, 2018 )),
						mktime( 0, 0, 0, 5, 01, 2018 ) => date("Y-m-d", mktime( 0, 0, 0, 5, 01, 2018 )),
						mktime( 0, 0, 0, 6, 01, 2018 ) => date("Y-m-d", mktime( 0, 0, 0, 6, 01, 2018 )),
					),
                    array(
                      'options' => array(
                            $model->date_create=>array('selected'=>true),
                      ))
                    );
                ?>
		<?php echo $form->error($model,'date_create'); ?>
	</div>

	<table>
		<thead>
			<tr>
				<th>Регион</th>
				<th>Цена за 1м2</th>
				<th>Изменение цены за 1м2</th>
				<th>Цена под ключ</th>
				<th>Изменение цены под ключ</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach (Region::model()->findAll(array('order'=>'id')) as $region) { ?>
			<tr>
				<td>
					<?= $region->name ?>
					<input type="hidden" name="Pricecity[<?= $region->id ?>][region_id]" value="<?= $region->id ?>" />
				</td>
				<td>
					<input type="text" name="Pricecity[<?= $region->id ?>][price]" />
				</td>
				<td>
					<input type="text" name="Pricecity[<?= $region->id ?>][diff]" />
				</td>
				<td>
					<input type="text" name="Pricecity[<?= $region->id ?>][price_key]" />
				</td>
				<td>
					<input type="text" name="Pricecity[<?= $region->id ?>][diff_key]" />
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this CompanyNewController */
/* @var $model CompanyNew */

$this->breadcrumbs=array(
	'Company News'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CompanyNew', 'url'=>array('index')),
	array('label'=>'Create CompanyNew', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#company-new-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Company News</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'company-new-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'name' => 'city_id',
			'type' => 'raw',
			'value' => '$data->city->gorod',
            'filter' => City::getList(),
        ),
		//'full_name',
		'address',
		'phone',
		'email',
		'user_email',
		'site',
		//'worktime',
		//'rating',
		//'online',
		'date_found',
		//'certificate',
		'guarantee',
		//'payment',
		'price',
		'promo',
		//'production_way',
		//'about',
		//'logo',
		//'donor_site',
		'url',
		//'user_email',
		array(
			'name' => 'is_accept',
			'type' => 'raw',
			'value' => '$data->is_accept ? "Да" : "Нет"',
            'filter' => array(0 => 'Нет', 1 => 'Да'),
        ),
		//'koord_x',
		//'koord_y',
		//'date_modify',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

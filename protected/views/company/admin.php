<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	'Companies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Company', 'url'=>array('index')),
	array('label'=>'Create Company', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#company-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Companies</h1>

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
	'id'=>'company-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		// 'full_name',
		// 'address',
		// 'phone',
		// 'email',
		'site',
		//'worktime',
		//'online',
		//'date_found',
		// 'certificate',
		//'guarantee',
		//'payment',
		//'price',
		//'promo',
		//'production_way',
		//'about',
		'logo',
		'url',
		array(
			'name' => 'city_id',
			'type' => 'raw',
			'value' => '$data->city->gorod',
            'filter' => City::getList(),
        ),
		//'donor_site',
		'rating',
		'priority',
		'views',
		//'koord_x',
		//'koord_y',
		// 'date_modify',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

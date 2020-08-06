<h1>Manage Feedback</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'feedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'created_at',
			'type' => 'raw',
			'value' => '$data->created_at ? date("d.m.Y", $data->created_at) : null',
        ),
		'name',
		'email',
		'message',
		'url',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>
